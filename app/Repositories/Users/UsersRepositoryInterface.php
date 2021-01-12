<?php

namespace App\Repositories\Users;

interface UsersRepositoryInterface
{

    public function getAuthUsers();

    public function getAuthUserById($id);

    public function createAuthUser($id);

    public function deleteAuthUserById($id);

    public function getFirestoreUsers();

    public function getFirestoreUserByEmail($email);
    public function getFirestoreUserByAuthId($authid);
    public function addUserDetail($user, $data);
    public function getFirestoreUserById($id);

    public function getStripeCustomerByUserId($id);

    public function createNewPaymentMethod($fullStripeToken);

    public function getPaymentMethodByOwnerId($ownerId);
    public function addReservations($data);
    public function getAllPaymentMethodsByOwnerId($ownerId);

    public function deletePaymentMethod($id);

    public function deleteAddress($id);

    public function createFirestoreUser($authId, $email);

    public function updateFirestoreUser($id, $data);

    public function deleteFirestoreUserById($id);

    public function createOrder($userObj, $dataArray, $fees,$tx);

    public function getOrderById($id);

    public function getOrdersByUserId($id);

    public function addUserAddress($user, $data);

    public function getUserAddresses($id);
    public function createReservationOrder($userObj, $dataArray, $fees,$tx,$reservation);
    public function updateOrder($orderRecord, $chargeId, $status);
    public function reservationOrder($orderRecord, $data);
    public function rushOrder($orderRecord, $fees);
    public function addFavorite($id, $user_id, $type, $data);

    public function removeFavorite($id);

    public function getFavorites($user_id, $type);

    public function checkFavorite($id);
}