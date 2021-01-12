<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DeliveryWebhookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Passwords\PasswordBroker;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/searchbox', [SearchController::class, 'getResults']);

Route::middleware(['auth.firebase'])->group(function(){
    Route::get('/authtest', function(){
        return 'Inside the auth test';
    });

    
});
Route::post('/test',[FirebaseController::class, 'index'])->name('test.res');
Route::post('/search',[FirebaseController::class, 'search'])->name('search.res');
Route::get('logintest', [UserController::class, 'loginTest']);


Route::get('/takeout', [HomeController::class, 'index'])->name('home');
Route::post('/takeout_page', [HomeController::class, 'index_page'])->name('home_page');
Route::get('/', [HomeController::class, 'index_landing'])->name('landing');
Route::get('/firebasework', [HomeController::class, 'firebasework'])->name('firebasework');

Route::get('/home/delivery/{lat}/{lng}', [HomeController::class, 'delivery'])->name('home.delivery');
Route::get('/fetch/restaurant', [HomeController::class, 'fetchRestaurants'])->name('fetch.restaurants');
Route::get('/home/reservation', [HomeController::class, 'reservation'])->name('home.reservation');
Route::post('/home/check/reservation', [HomeController::class, 'reservationCheck'])->name('check.reservation');
Route::get('/prev', function(){
    return view('app.home-prev', [
        'restaurants' => [],
        'categories' => []
    ]);
});
Route::get('/reset',function(){
    return view('passwordreset');
})->name('reset.blade');
  Route::post('resetform', [AuthController::class, 'passwordReset'])->name('reset.form');
  Route::post('registerform', [AuthController::class, 'google'])->name('googlenew.form');
   Route::post('registerfacebookform', [AuthController::class, 'facebook'])->name('facebook.form');
   Route::post('registerappleform', [AuthController::class, 'apple'])->name('apple.form');
Route::get('/cartmodel', function(){
    session()->forget('cart');
    $cart = new \App\Models\Firebase\Cart;
    $cart->vendor = "asdfasflasffasf";
    $cart->items = array(
        ['id' => 'h1234', 'name' => 'nothing'],
    );
    session()->put('cart', $cart);
    return json_encode(session('cart'));
});

/**** AUTHENTICATION ****/

Route::middleware(['auth.firebase-guest'])->group(function(){
    Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login.check');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

/**** CHECKOUT *****/
Route::get('/checkout', [CheckoutController::class, 'index'])->name('app.checkout.index');
Route::post('/checkout/submit', [CheckoutController::class, 'attemptOrder'])->name('app.checkout.submit');
Route::get('/checkrelayform/{token}', [CheckoutController::class, 'checkRelayForm'])->name('app.checkrelayform');


/***** RESTAURANTS ******/

Route::get('/restaurants', [RestaurantController::class, 'index'])->name('app.restaurants.index');

Route::get('/restaurant/add', [RestaurantController::class, 'addRestaurant'])->name('app.restaurant.add');
Route::post('/restaurant/save', [RestaurantController::class, 'saveRestaurant'])->name('app.restaurant.save');

Route::get('/restaurant/register/new', [RestaurantController::class, 'showRegister'])->name('app.restaurant.show-register');
Route::get('/restaurant/menuitem', [RestaurantController::class, 'showMenuItem'])->name('app.restaurant.menuitem.show');
Route::get('/restaurant/select-new/{restaurantId}', [RestaurantController::class, 'selectNew'])->name('app.restaurant.select-new');
Route::get('/restaurant/go-back/{restaurantId}', [RestaurantController::class, 'goBack'])->name('app.restaurant.go-back');

Route::get('/restaurant/{id}', [RestaurantController::class, 'showRestaurant'])->name('app.restaurant.show');


/**** CATEGORIES *****/

Route::get('/category/{id}', [CategoriesController::class, 'showCategory'])->name('app.category.show');
Route::get('/category/{id}/{lat}/{lng}', [CategoriesController::class, 'showDeliveryCategory'])->name('app.category.show.delivery');

/**** USER *****/

Route::get('/user/orders', [UserController::class, 'showPastOrders'])->name('app.user.orders.past');

Route::get('/user/order/{id}', [UserController::class, 'showOrder'])->name("app.user.order.show");

Route::get('/privacy', [UserController::class, 'showPrivacy'])->name("app.user.privacy.show");
Route::get('/privacy_policy', [UserController::class, 'showPrivacy'])->name("app.user.privacy.show");
Route::get('/privacy.html', [UserController::class, 'showPrivacy'])->name("app.user.privacy.show");

Route::get('/remove', [UserController::class, 'showRemove'])->name("app.user.remove.show");
Route::post('/user/remove', [UserController::class, 'removeUserInfo'])->name('app.user.info.remove');

Route::get('/user/account', [UserController::class, 'showAccount'])->name("app.user.account.show");

Route::post('/user/account/update', [UserController::class, 'updateAccount'])->name('app.user.account.update');
Route::post('/user/address/update', [UserController::class, 'updateAddress'])->name('address.update');
Route::post('/user/address/add', [UserController::class, 'addAddress'])->name('app.user.address.add');

Route::post('/user/address/delete', [UserController::class, 'deleteAddress'])->name('app.user.address.delete');

Route::get('/user/wallet', [UserController::class, 'showWallet'])->name("app.user.wallet.show");

Route::get('/user/wallet/edit', [UserController::class, 'editWallet'])->name("app.user.wallet.edit");

Route::post('/user/card/delete', [UserController::class, 'deleteCard'])->name('app.user.card.delete');



Route::post('/user/card/add', [UserController::class, 'storeCard'])->name('app.user.card.store');

Route::get('/user/favorite', [UserController::class, 'showFavorite'])->name("app.user.favorite.show");

Route::get('/cart/get-data', [CartController::class, 'getData'])->name('app.cart.get-data');
Route::post('/cart/item/add', [CartController::class, 'addItem'])->name('app.cart.add-item');
Route::post('/cart/item/remove', [CartController::class, 'removeItem'])->name('app.cart.remove-item');
Route::post('/cart/item/remove-all', [CartController::class, 'removeAll'])->name('app.cart.remove-all');

/**** WEBHOOKS *****/

Route::post('/webhooks/relay/{type}', [DeliveryWebhookController::class, 'handle'])->name('webhooks.relay');

/**** Home *****/
Route::get('/about-us', [HomeController::class, 'showAbout'])->name("app.about");
Route::get('/blog', [HomeController::class, 'showBlog'])->name("app.blog");
Route::get('/covid-19', [HomeController::class, 'showCovid19'])->name("app.covid-19");
Route::get('/membership', [HomeController::class, 'showMembership'])->name("app.membership");
Route::get('/our-team', [HomeController::class, 'showOurTeam'])->name("app.our-team");
Route::get('/why-choose-us', [HomeController::class, 'showWhyChooseUs'])->name("app.why-choose-us");
Route::post('/email-submit', [AboutController::class, 'emailSubmit'])->name('email.submit');
Route::get('/mobileapp', [HomeController::class, 'mobileApp'])->name('app.mobileapp');

/***** FAVORITE ******/

Route::post('/add-favorite', [FavoriteController::class, 'addFavorite'])->name('app.add-favorite');
Route::post('/remove-favorite', [FavoriteController::class, 'removeFavorite'])->name('app.remove-favorite');

/***** HELP *****/

Route::get('/help', [UserController::class, 'showHelp'])->name('app.user.help');

/***** Search *****/

Route::get('/search_result', [HomeController::class, 'showSearch'])->name('app.home.search');