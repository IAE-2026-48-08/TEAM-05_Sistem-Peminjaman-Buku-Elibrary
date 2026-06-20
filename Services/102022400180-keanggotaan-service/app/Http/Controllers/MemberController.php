<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiResponse;
use App\Models\Member;
use App\Services\RabbitMQService;
use App\Services\SoapService;
use App\Services\SsoService;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    protected SoapService $soapService;
    protected SsoService $ssoService;
    protected RabbitMQService $rabbitMQService;

    public function __construct(SoapService $soapService, SsoService $ssoService, RabbitMQService $rabbitMQService)
    {
        $this->soapService     = $soapService;
        $this->ssoService      = $ssoService;
        $this->rabbitMQService = $rabbitMQService;
    }

    public function show($id)
    {
        $member = Member::find($id);

        if (!$member) {
            return ApiResponse::error('Member not found', null, 404);
        }

        return ApiResponse::success($member, 'Member retrieved successfully');
    }

    public function status($id)
    {
        $member = Member::find($id);

        if (!$member) {
            return ApiResponse::error('Member not found', null, 404);
        }

        return ApiResponse::success([
            'id'     => $member->id,
            'status' => $member->status,
        ], 'Member status retrieved successfully');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string',
            'email'      => 'required|email|unique:members,email',
            'phone'      => 'nullable|string',
            'status'     => 'nullable|in:active,inactive,suspended',
            'joined_at'  => 'nullable|date',
            'expired_at' => 'nullable|date',
        ]);

        // Simpan member
        $member = Member::create($validated);

        // Ambil M2M token untuk SOAP
        $token = $this->ssoService->getM2MToken();

        // Kirim audit ke SOAP
        $soapResult = $this->soapService->sendAudit(
            'MemberRegistered',
            [
                'member_id' => $member->id,
                'name'      => $member->name,
                'email'     => $member->email,
                'status'    => $member->status,
            ],
            $token
        );

        // Simpan receipt number
        $member->update(['receipt_number' => $soapResult['receipt_number']]);

        // Publish event ke RabbitMQ
        $published = $this->rabbitMQService->publish(
            'member.registered',
            [
                'event'     => 'member.registered',
                'service'   => 'Keanggotaan-Service',
                'data'      => [
                    'member_id' => $member->id,
                    'name'      => $member->name,
                    'email'     => $member->email,
                    'status'    => $member->status,
                ],
                'timestamp' => now()->toISOString(),
            ],
            $token
        );

        return ApiResponse::success([
            'member'           => $member,
            'receipt_number'   => $soapResult['receipt_number'],
            'soap_status'      => $soapResult['status'],
            'rabbitmq_published' => $published,
        ], 'Member created successfully', null, 201);
    }
}