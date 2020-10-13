<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Database\Seeders\DatabaseSeeder;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Laravel OpenApi Demo Documentation",
 *      description="L5 Swagger OpenApi description",
 *      @OA\Contact(
 *          email="admin@admin.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Demo API Server"
 * )

 *
 * @OA\Tag(
 *     name="Projects",
 *     description="API Endpoints of Projects"
 * )
 */
class ApiController extends Controller
{
    /**
     * @OA\Get(
     *      path="api/customers",
     *      operationId="getAllCustomers",
     *      tags={"Customer"},
     *      summary="Get list of customers",
     *      description="Returns list of customers",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         description="Costumer id"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         description="Costumer name"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         description="Costumer create at date"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         description="Costumer update at date"
     *                     ),
     *                     example={
     *                          {
     *                         "id": 1,
     *                         "name": "Alfred",
     *                         "created_at": "2020-10-07T13:44:01.000000Z",
     *                         "updated_at": "2020-10-07T14:21:00.000000Z"
     *                          },
     *                          {
     *                         "id": 2,
     *                         "name": "Jon Snow",
     *                         "created_at": "2020-10-07T14:00:58.000000Z",
     *                         "updated_at": "2020-10-07T14:01:12.000000Z"
     *                          }
     *                     }
     *                 )
     *             )
     *         }
     *       )
     *     )
     */
    public function getAllCustomers() {
        $customers = Customer::get()->toJson(JSON_PRETTY_PRINT);
        return response($customers, 200);
    }

    public function getTest() {
//        dd(Request::ip())
//        $seeder = new DatabaseSeeder();
//
//        $seeder->run();

//        dd('asdasd');
// Test database connection
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            dd("Could not connect to the database.  Please check your configuration. error:" . $e );
        }
//        env("APP_NAME", "somedefaultvalue");
//        dd(env("DB_USERNAME", "somedefaultvalue"));
//        try {
//            DB::connection()->getPdo();
//            if(DB::connection()->getDatabaseName()){
//                echo "Yes! Successfully connected to the DB: " . DB::connection()->getDatabaseName();
//            }else{
//                die("Could not find the database. Please check your configuration.");
//            }
//        } catch (\Exception $e) {
//            die("Could not open connection to database server.  Please check your configuration.".$e);
//        }
//        $servername = "127.0.0.1";
//        $username = "laraveluser";
//        $password = "laravel_db_password";
//
//        try {
//            $conn = new PDO("mysql:host=$servername;port=3307;dbname=laravel", $username, $password);
//            // set the PDO error mode to exception
//            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            dd( "Connected successfully");
//        }
//        catch(PDOException $e)
//        {
//            dd( "Connection failed: " . $e->getMessage());
//        }
    }

    /**
     * @OA\Post(
     *      path="api/customer",
     *      operationId="createCustomer",
     *      tags={"Customer"},
     *      summary="Create new customer",
     *      description="Create new customer in database",
     *      @OA\RequestBody(
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  @OA\Property(property="name", type="string", collectionFormat="multi", @OA\Items(type="string")),
     *                  required={"name"}
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Customer record created"
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="name is required"
     *      )
     * )
     */
    public function createCustomer(Request $request) {
        if (is_null($request->name)) {
            return response()->json([
                "message" => 'name is required'
            ], 404);
        }
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->save();

        return response()->json([
            "message" => "Customer record created"
        ], 201);
    }

    /**
     * @OA\Get(
     *      path="api/customer/{id}",
     *      operationId="getCustomer",
     *      tags={"Customer"},
     *      summary="Customer details",
     *      description="Get customer details",
     *      @OA\Parameter(
     *         description="id is required",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Customer details",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         description="Costumer id"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         description="Costumer name"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         description="Costumer create at date"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         description="Costumer update at date"
     *                     ),
     *                     example={
     *                         "id": 2,
     *                         "name": "Jon Snow",
     *                         "created_at": "2020-10-07T14:00:58.000000Z",
     *                         "updated_at": "2020-10-07T14:01:12.000000Z"
     *                     }
     *                 )
     *             )
     *         }
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Customer not found"
     *      )
     * )
     */
    public function getCustomer($id) {
        if (Customer::where('id', $id)->exists()) {
            $customer = Customer::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($customer, 200);
        } else {
            return response()->json([
                "message" => "Customer not found"
            ], 404);
        }
    }

    /**
     * @OA\Put (
     *      path="api/customer/{id}",
     *      operationId="updateCustomer",
     *      tags={"Customer"},
     *      summary="Update customer",
     *      description="Update customer data",
     *      @OA\Parameter(
     *         description="id is required",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *      ),
     *      @OA\RequestBody(
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  @OA\Property(property="name", type="string", collectionFormat="multi", @OA\Items(type="string")),
     *                  required={"name"}
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Customer records updated successfully"
     *       ),
     *      @OA\Response(
     *          response=403,
     *          description="name is required"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Customer not found"
     *      )
     * )
     */
    public function updateCustomer(Request $request, $id) {
        if (is_null($request->name)) {
            return response()->json([
                "message" => 'name is required'
            ], 403);
        }
        if (Customer::where('id', $id)->exists()) {
            $customer = Customer::find($id);
            $customer->name = $request->name;
            $customer->save();

            return response()->json([
                "message" => "Customer records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Customer not found"
            ], 404);
        }
    }

    /**
     * @OA\Delete(
     *      path="api/customer/{id}",
     *      operationId="deleteCustomer",
     *      tags={"Customer"},
     *      summary="Delete customer",
     *      description="Remove customers from database",
     *      @OA\Parameter(
     *         description="id is required",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Customer record deleted"
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Customer not found"
     *      )
     * )
     */
    public function deleteCustomer($id) {
        if(Customer::where('id', $id)->exists()) {
            $customer = Customer::find($id);
            $customer->delete();

            return response()->json([
                "message" => "Customer record deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Customer not found"
            ], 404);
        }
    }

    /**
     * @OA\Get(
     *      path="api/customer/{id}/addresses",
     *      operationId="getAllAddresses",
     *      tags={"Address"},
     *      summary="Get list of addresses",
     *      description="Returns list of addresses for current customer",
     *      @OA\Parameter(
     *         description="id is required",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         description="Address id"
     *                     ),
     *                     @OA\Property(
     *                         property="street",
     *                         type="string",
     *                         description="Street name"
     *                     ),
     *                     @OA\Property(
     *                         property="city",
     *                         type="string",
     *                         description="City name"
     *                     ),
     *                     @OA\Property(
     *                         property="customer_id",
     *                         type="integer",
     *                         description="Customer id"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         description="Address create at date"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         description="Address update at date"
     *                     ),
     *                     example={
     *                          {
     *                         "id": 1,
     *                         "street": "Wiejska 13",
     *                         "city": "Warsaw",
     *                         "customer_id": "1",
     *                         "created_at": "2020-10-07T14:44:01.000000Z",
     *                         "updated_at": "2020-10-07T15:21:00.000000Z"
     *                          },
     *                          {
     *                         "id": 2,
     *                         "street": "Nowowiejska 8b",
     *                         "city": "Warsaw",
     *                         "customer_id": "1",
     *                         "created_at": "2020-10-07T15:00:58.000000Z",
     *                         "updated_at": "2020-10-07T16:01:12.000000Z"
     *                          }
     *                     }
     *                 )
     *             )
     *         }
     *     ),
     *     @OA\Response(
     *          response=404,
     *          description="Customer not found"
     *     )
     * )
     */
    public function getAllAddresses($id) {
        if (Customer::where('id', $id)->exists()) {
            $customer = Customer::find($id);
            $addresses = $customer->addresses->toJson(JSON_PRETTY_PRINT);

            return response($addresses, 200);
        } else {
            return response()->json([
                "message" => "Customer not found"
            ], 404);
        }
    }

    /**
     * @OA\Post(
     *      path="api/customer/{id}/address",
     *      operationId="createAddress",
     *      tags={"Address"},
     *      summary="Create address",
     *      description="Create new address for current customer",
     *      @OA\Parameter(
     *         description="id is required",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *      ),
     *      @OA\RequestBody(
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  @OA\Property(property="city", type="string", collectionFormat="multi", @OA\Items(type="string")),
     *                  @OA\Property(property="street", type="string", collectionFormat="multi", @OA\Items(type="string")),
     *                  required={"name", "street"}
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Address record created"
     *     ),
     *      @OA\Response(
     *          response=403,
     *          description="street and city are required"
     *     ),
     *     @OA\Response(
     *          response=404,
     *          description="Customer not found"
     *     )
     * )
     */
    public function createAddress(Request $request, $id) {
        if (is_null($request->street) OR is_null($request->city)) {
            return response()->json([
                "message" => 'street and city are required'
            ], 403);
        }
        if (Customer::where('id', $id)->exists()) {
            $address = new Address();
            $address->street = $request->street;
            $address->city = $request->city;
            $address->customer_id = $id;
            $address->save();

            return response()->json([
                "message" => "Address record created"
            ], 201);
        } else {
            return response()->json([
                "message" => "Customer not found"
            ], 404);
        }
    }

    /**
     * @OA\Get(
     *      path="api/address/{id}",
     *      operationId="getAddress",
     *      tags={"Address"},
     *      summary="Get one address",
     *      description="Return address by id",
     *      @OA\Parameter(
     *         description="id is required",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         description="Address id"
     *                     ),
     *                     @OA\Property(
     *                         property="street",
     *                         type="string",
     *                         description="Street name"
     *                     ),
     *                     @OA\Property(
     *                         property="city",
     *                         type="string",
     *                         description="City name"
     *                     ),
     *                     @OA\Property(
     *                         property="customer_id",
     *                         type="integer",
     *                         description="Customer id"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         description="Address create at date"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         description="Address update at date"
     *                     ),
     *                     example={
     *                         "id": 1,
     *                         "street": "Wiejska 13",
     *                         "city": "Warsaw",
     *                         "customer_id": "1",
     *                         "created_at": "2020-10-07T14:44:01.000000Z",
     *                         "updated_at": "2020-10-07T15:21:00.000000Z"
     *                     }
     *                 )
     *             )
     *         }
     *     ),
     *     @OA\Response(
     *          response=404,
     *          description="Address not found"
     *     )
     * )
     */
    public function getAddress($id) {
        if (Address::where('id', $id)->exists()) {
            $address = Address::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($address, 200);
        } else {
            return response()->json([
                "message" => "Address not found"
            ], 404);
        }
    }

    /**
     * @OA\Put (
     *      path="api/address/{id}",
     *      operationId="updateAddress",
     *      tags={"Address"},
     *      summary="Update address",
     *      description="Update address data",
     *      @OA\Parameter(
     *         description="id is required",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *      ),
     *      @OA\RequestBody(
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  @OA\Property(property="street", type="string", collectionFormat="multi", @OA\Items(type="string")),
     *                  @OA\Property(property="city", type="string", collectionFormat="multi", @OA\Items(type="string")),
     *                  required={"street", "city"}
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Address records updated successfully"
     *       ),
     *      @OA\Response(
     *          response=403,
     *          description="street and city are required"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Address not found"
     *      )
     * )
     */
    public function updateAddress(Request $request, $id) {
        if (is_null($request->street) OR is_null($request->city)) {
            return response()->json([
                "message" => 'street and city are required'
            ], 404);
        }
        if (Address::where('id', $id)->exists()) {
            $address = Address::find($id);
            $address->street = $request->street;
            $address->city = $request->city;
            $address->save();

            return response()->json([
                "message" => "Address records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Address not found"
            ], 404);
        }
    }

    /**
     * @OA\Delete(
     *      path="api/address/{id}",
     *      operationId="deleteAddress",
     *      tags={"Address"},
     *      summary="Delete address",
     *      description="Remove address from database",
     *      @OA\Parameter(
     *         description="id is required",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Address record deleted"
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Address not found"
     *      )
     * )
     */
    public function deleteAddress($id) {
        if(Address::where('id', $id)->exists()) {
            $address = Address::find($id);
            $address->delete();

            return response()->json([
                "message" => "Address record deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Address not found"
            ], 404);
        }
    }
}
