<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileIndexRequest;
use App\Services\FileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
    /**
     * AccountController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $response = (new FileService())->hello();

        return  Response::json([
            'message' => $response,
        ], 401);
    }

//    /**
//     * @param AccountOnlyCreateRequest $request
//     * @return AccountResource
//     */
//    public function create(AccountOnlyCreateRequest $request)
//    {
//        $input = $request->getInput();
//        $account = (new AccountService())->storeAccount($input, auth()->user());
//
//        return new AccountResource($account);
//    }
//
//    /**
//     * @param Account $account
//     * @return AccountResource
//     */
//    public function read(Account $account): AccountResource
//    {
//        $account->load(['accountType', 'accountManager', 'defaultProduct']);
//        return new AccountResource($account);
//    }
//
//    /**
//     * @param AccountUpdateRequest $request
//     * @param Account $account
//     * @return AccountResource
//     */
//    public function update(AccountUpdateRequest $request, Account $account)
//    {
//        $input = $request->getInput();
//        $account = (new AccountService())->updateAccount($account, $input);
//
//        return new AccountResource($account);
//    }
//
//    /**
//     * @param Account $account
//     * @return JsonResponse
//     */
//    public function delete(Account $account)
//    {
//        (new AccountService())->destroyAccount($account, auth()->user());
//
//        return JsonResponse::create();
//    }
}
