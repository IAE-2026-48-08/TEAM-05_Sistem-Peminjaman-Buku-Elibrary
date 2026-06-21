<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use App\Services\SoapAuditService;
use App\Services\RabbitMqService;
use App\Services\MemberService;

#[OA\Tag(
    name: "Books",
    description: "API Katalog Buku"
)]
class BookController extends Controller
{
    private $books = [
        [
            "id" => 1,
            "title" => "Laskar Pelangi",
            "author" => "Andrea Hirata",
            "publisher" => "Bentang",
            "year" => 2005
        ],
        [
            "id" => 2,
            "title" => "Bumi",
            "author" => "Tere Liye",
            "publisher" => "Gramedia",
            "year" => 2014
        ]
    ];

    #[OA\Get(
        path: "/api/v1/catalog/books",
        summary: "Get all books",
        tags: ["Books"],
        security: [["ApiKeyAuth" => []]],
        responses: [
            new OA\Response(
                response: 200,
                description: "Success"
            )
        ]
    )]
    public function index()
    {
        return response()->json($this->books);
    }

    #[OA\Get(
        path: "/api/v1/catalog/books/{id}",
        summary: "Get book by ID",
        tags: ["Books"],
        security: [["ApiKeyAuth" => []]],
        responses: [
            new OA\Response(
                response: 200,
                description: "Success"
            ),
            new OA\Response(
                response: 401,
                description: "Book not found"
            )
        ]
    )]
    public function show($id)
    {
        foreach ($this->books as $book) {
            if ($book['id'] == $id) {
                return response()->json($book);
            }
        }

        return response()->json([
            "message" => "Book not found"
        ], 401);
    }

    #[OA\Post(
        path: "/api/v1/catalog/books",
        summary: "Create book",
        tags: ["Books"],
        security: [["ApiKeyAuth" => []]],
        responses: [
            new OA\Response(
                response: 201,
                description: "Book created"
            )
        ]
    )]


public function store(Request $request)
{
    SoapAuditService::send();

    return response()->json([
        "message" => "Book created successfully",
        "data" => $request->all()
    ], 201);
}

    public function booksForMember($memberId)
    {
        $member = MemberService::getStatus($memberId);

        if (
            !isset($member['data']['status']) ||
            $member['data']['status'] !== 'active'
        ) {
            return response()->json([
                'status' => 'error',
                'message' => 'Member tidak aktif'
            ], 403);
        }

        return response()->json($this->books);
    }
}