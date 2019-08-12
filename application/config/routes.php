<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */
$route['default_controller'] = 'site';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;


// Admin Login
$route['admin'] = "admin/admin/index";
$route['admin/checkLogin'] = "admin/admin/checkLogin";
$route['admin/dashboard'] = "admin/admin/dashboard";
$route['partner/dashboard'] = "admin/admin/dashboard";
$route['courier/dashboard'] = "admin/admin/dashboard";
$route['admin/change-password'] = "admin/admin/change-password";
$route['admin/doChangePassword'] = "admin/admin/doChangePassword";
$route['admin/logout'] = "admin/admin/logout";
$route['admin/profile'] = "admin/admin/profile";
$route['admin/doUpdateProfile'] = "admin/admin/doUpdateProfile";
$route['admin/forgot-password'] = "admin/admin/forgot_password";
$route['admin/forgot_password_checked'] = "admin/admin/forgot_password_checked";
$route['admin/password-reset/(:any)/(:any)'] = "admin/admin/password_reset/$1/$2";
$route['admin/update_forgot_password'] = "admin/admin/update_forgot_password";

//Partner Login
$route['partner'] = "admin/partner";
$route['partner/checkLogin'] = "admin/partner/checkLogin";
$route['partner/dashboard'] = "admin/partner/dashboard";
$route['partner/change-password'] = "admin/partner/change-password";
$route['partner/doChangePassword'] = "admin/partner/doChangePassword";
$route['partner/logout'] = "admin/partner/logout";
$route['partner/profile'] = "admin/partner/profile";
$route['partner/forgot-password'] = "admin/partner/forgot_password";
$route['partner/password-reset/(:any)/(:any)'] = "admin/partner/password_reset/$1/$2";
$route['partner/doUpdateProfile'] = "admin/partner/doUpdateProfile";

//Partner Courier
$route['courier'] = "admin/courier";
$route['courier/checkLogin'] = "admin/courier/checkLogin";
$route['courier/dashboard'] = "admin/courier/dashboard";
$route['courier/change-password'] = "admin/courier/change-password";
$route['courier/doChangePassword'] = "admin/courier/doChangePassword";
$route['courier/logout'] = "admin/courier/logout";
$route['courier/profile'] = "admin/courier/profile";
$route['courier/doUpdateProfile'] = "admin/courier/doUpdateProfile";
$route['courier/forgot-password'] = "admin/courier/forgot_password";
$route['courier/password-reset/(:any)/(:any)'] = "admin/courier/password_reset/$1/$2";

//Store Category
$route['admin/storeCategory'] = "admin/storeCategory/index";
$route['admin/storeCategory/(:any)'] = "admin/storeCategory/index/$1";
$route['admin/get-store-category-wrapper'] = "admin/storeCategory/get-store-category-wrapper";
$route['admin/doAddCategory'] = "admin/storeCategory/doAddCategory";
$route['admin/doEditCategory/(:any)'] = "admin/storeCategory/doEditCategory/$1";
$route['admin/changeCategoryStatus/(:any)/(:any)'] = "admin/storeCategory/changeCategoryStatus/$1/$2";

//User Specification
$route['admin/user-specification'] = "admin/AdminUserSpecification/index";
$route['admin/user-specification/(:any)'] = "admin/AdminUserSpecification/index/$1";
$route['admin/get-specification-wrapper'] = "admin/AdminUserSpecification/get-specification-wrapper";
$route['admin/do-add-specification'] = "admin/AdminUserSpecification/do-add-specification";
$route['admin/do-edit-specification/(:any)'] = "admin/AdminUserSpecification/do-edit-specification/$1";
$route['admin/user-specification/change_specification_status/(:any)/(:any)'] = "admin/AdminUserSpecification/change_specification_status/$1/$2";

//Partner
$route['admin/partnerSection'] = "admin/partnerSection/index";
$route['admin/get-partner-wrapper'] = "admin/partnerSection/get-partner-wrapper";
$route['admin/changePartnerStatus/(:any)/(:any)'] = "admin/partnerSection/changePartnerStatus/$1/$2";
$route['admin/addPartner'] = "admin/partnerSection/addPartner";
$route['admin/doAddPartner'] = "admin/partnerSection/doAddPartner";
$route['admin/doEditPartner/(:any)'] = "admin/partnerSection/doEditPartner/$1";

//Partner Application
$route['admin/partner-application'] = "admin/partnerSection/partner-application";
$route['admin/viewPartnerEnquiry/(:any)'] = "admin/partnerSection/viewPartnerEnquiry/$1";
$route['admin/get-partner-enquiry-wrapper'] = "admin/partnerSection/get-partner-enquiry-wrapper";

// Admin Store
$route['admin/adminStore'] = "admin/adminStore/index";
$route['admin/get-store-wrapper'] = "admin/adminStore/get-store-wrapper";
$route['admin/changeStoreStatus/(:any)/(:any)'] = "admin/adminStore/changeStoreStatus/$1/$2";
$route['admin/changeStoreStatusOpenOrClose/(:any)/(:any)'] = "admin/adminStore/changeStoreStatusOpenOrClose/$1/$2";
$route['admin/changeStoreDeliveryChargeOnOrOff/(:any)/(:any)'] = "admin/adminStore/changeStoreDeliveryChargeOnOrOff/$1/$2";
$route['admin/StoreDeliveryChargeType/(:any)/(:any)'] = "admin/adminStore/StoreDeliveryChargeType/$1/$2";
$route['admin/addStore'] = "admin/adminStore/addStore";
$route['admin/editStore/(:any)'] = "admin/adminStore/editStore/$1";
//$route['admin/bydefault-warpper'] = "admin/adminStore/get_bydefault_wrapper/$1";
$route['admin/doAddStore'] = "admin/adminStore/doAddStore";
$route['admin/doEditStore/(:any)'] = "admin/adminStore/doEditStore/$1";
$route['admin/doEditStoreInfo/(:any)'] = "admin/adminStore/doEditStoreInfo/$1";
$route['admin/doEditStoreAddress/(:any)'] = "admin/adminStore/doEditStoreAddress/$1";
$route['admin/doEditStoreOperation/(:any)'] = "admin/adminStore/doEditStoreOperation/$1";
$route['admin/doEditStoreDeliveryTax/(:any)'] = "admin/adminStore/doEditStoreDeliveryTax/$1";
$route['admin/doEditStoreBank/(:any)'] = "admin/adminStore/doEditStoreBank/$1";

//Admin store deliver charges
$route['admin/storeDeliveryCharges'] = "admin/adminStore/storeDeliveryCharges";
$route['admin/get-store-delivery-charges-wrapper'] = "admin/adminStore/get_store_delivery_charges_wrapper";
$route['admin/addStoreDeliveryCharges'] = "admin/adminStore/addStoreDeliveryCharges";
$route['admin/addStoreDeliveryCharges/(:any)'] = "admin/adminStore/addStoreDeliveryCharges/$1";
$route['admin/doAddStoreDeliveryCharges'] = "admin/adminStore/doAddStoreDeliveryCharges";
$route['admin/doEditStoreDeliveryCharges/(:any)'] = "admin/adminStore/doEditStoreDeliveryCharges/$1";

//Admin restaurant  deliver charges
$route['admin/restaurantDeliveryCharges'] = "admin/adminRestaurant/restaurantDeliveryCharges";
$route['admin/get-restaurant-delivery-charges-wrapper'] = "admin/adminRestaurant/get_restaurant_delivery_charges_wrapper";
$route['admin/addRestaurantDeliveryCharges'] = "admin/adminRestaurant/addRestaurantDeliveryCharges";
$route['admin/addRestaurantDeliveryCharges/(:any)'] = "admin/adminRestaurant/addRestaurantDeliveryCharges/$1";
$route['admin/doAddRestaurantDeliveryCharges'] = "admin/adminRestaurant/doAddRestaurantDeliveryCharges";
$route['admin/doEditRestaurantDeliveryCharges/(:any)'] = "admin/adminRestaurant/doEditRestaurantDeliveryCharges/$1";


//Shop Section
/*$route['admin/shop-section'] = "admin/store/shop-section";
$route['partner/shop-section'] = "admin/store/shop-section";
$route['admin/shop-section/(:any)'] = "admin/store/shop-section/$1";
$route['partner/shop-section/(:any)'] = "admin/store/shop-section/$1";
$route['admin/get-shop-section-wrapper'] = "admin/store/get-shop-section-wrapper";
$route['admin/doAddShopSection'] = "admin/store/doAddShopSection";
$route['admin/doEditShopSection/(:any)'] = "admin/store/doEditShopSection/$1";
$route['admin/changeShopSectionStatus/(:any)/(:any)'] = "admin/store/changeShopSectionStatus/$1/$2";
*/
//Admin Shop Section
$route['admin/shop-section'] = "admin/adminStore/shop-section";
$route['admin/shop-section/(:any)'] = "admin/adminStore/shop-section/$1";
$route['admin/get-shop-section-wrapper'] = "admin/adminStore/get-shop-section-wrapper";
$route['admin/doAddShopSection'] = "admin/adminStore/doAddShopSection";
$route['admin/doEditShopSection/(:any)'] = "admin/adminStore/doEditShopSection/$1";
$route['admin/changeShopSectionStatus/(:any)/(:any)'] = "admin/adminStore/changeShopSectionStatus/$1/$2";

//Admin Product
$route['admin/adminProduct/(:any)/(:any)'] = "admin/adminProduct/index/$1/$2";
$route['admin/get-product-wrapper/(:any)/(:any)'] = "admin/adminProduct/get-product-wrapper/$1/$2";
$route['admin/add-product/(:any)/(:any)'] = "admin/adminProduct/add-product/$1/$2";
$route['admin/add-product/(:any)/(:any)/(:any)'] = "admin/adminProduct/add-product/$1/$2/$3";
$route['admin/doAddProduct'] = "admin/adminProduct/doAddProduct";
$route['admin/changeProductStatus/(:any)/(:any)'] = "admin/adminProduct/changeProductStatus/$1/$2";
$route['admin/removeProductGroupMapping/(:any)'] = "admin/adminProduct/removeProductGroupMapping/$1";
$route['admin/adminProduct/(:any)'] = "admin/adminProduct/manage_product_wrapper/$1";

//Admin Product Sku
// $route['admin/view-product-sku/(:any)/(:any)/(:any)'] = "admin/adminProduct/view-product-sku/$1/$2/$3";
// $route['admin/get-product-sku-wrapper/(:any)/(:any)/(:any)'] = "admin/adminProduct/get-product-sku-wrapper/$1/$2/$3";
// $route['admin/add-product-sku/(:any)/(:any)/(:any)'] = "admin/adminProduct/add-product-sku/$1/$2/$3";
// $route['admin/doAddProductSku/(:any)/(:any)/(:any)'] = "admin/adminProduct/doAddProductSku/$1/$2/$3";
// $route['admin/add-product-sku/(:any)/(:any)/(:any)/(:any)'] = "admin/adminProduct/add-product-sku/$1/$2/$3/$4";
// $route['admin/get-product-sku-image-wrapper/(:any)'] = "admin/adminProduct/get-product-sku-image-wrapper/$1";
// $route['admin/doDeleteProductSkuImage/(:any)'] = "admin/adminProduct/doDeleteProductSkuImage/$1";
// $route['admin/doEditProductSku/(:any)/(:any)/(:any)/(:any)'] = "admin/adminProduct/doEditProductSku/$1/$2/$3/$4";
// $route['admin/changeProductSkuStatus/(:any)/(:any)'] = "admin/adminProduct/changeProductSkuStatus/$1/$2";

//language 
$route['admin/language'] = "admin/language/index";
$route['admin/language/(:any)'] = "admin/language/index/$1";
$route['admin/get-language-wrapper'] = "admin/language/get-language-wrapper";
$route['admin/doAddLanguage'] = "admin/language/doAddLanguage";
$route['admin/doEditLanguage/(:any)'] = "admin/language/doEditLanguage/$1";
$route['admin/changeLanguageStatus/(:any)/(:any)'] = "admin/language/changeLanguageStatus/$1/$2";

//Language Text
$route['admin/text'] = "admin/language/text";
$route['admin/text/(:any)'] = "admin/language/text/$1";
$route['admin/get-language-text-wrapper'] = "admin/language/get-language-text-wrapper";
$route['admin/doAddText'] = "admin/language/doAddText";
$route['admin/doEditText/(:any)'] = "admin/language/doEditText/$1";
$route['admin/changeLanguageTextStatus/(:any)/(:any)'] = "admin/language/changeLanguageTextStatus/$1/$2";
$route['admin/textlang/(:any)'] = "admin/language/textlang/$1";
$route['admin/update-text-lang/(:any)'] = "admin/language/update-text-lang/$1";

//Category
$route['admin/restaurant-category'] = "admin/restaurant_category/restaurant-category";
$route['admin/restaurant-category/(:any)'] = "admin/restaurant_category/restaurant-category/$1";
$route['admin/get-restaurant-category-wrapper'] = "admin/restaurant_category/get-restaurant-category-wrapper";
$route['admin/doAddRestaurantCategory'] = "admin/restaurant_category/doAddRestaurantCategory";
$route['admin/doEditRestaurantCategory/(:any)'] = "admin/restaurant_category/doEditRestaurantCategory/$1";
$route['admin/changeRestaurantCategoryStatus/(:any)/(:any)'] = "admin/restaurant_category/changeRestaurantCategoryStatus/$1/$2";

$route['admin/adminSubscriber'] = "admin/adminSubscriber/index";
$route['admin/get_subscriber_review_wrapper'] = "admin/adminSubscriber/get_subscriber_review_wrapper";

//Country
$route['admin/country'] = "admin/country";
$route['admin/get-country-wrapper'] = "admin/country/get-country-wrapper";
$route['admin/country/(:any)'] = "admin/country/index/$1";
$route['admin/doAddCountry'] = "admin/country/doAddCountry";
$route['admin/doEditCountry/(:any)'] = "admin/country/doEditCountry/$1";
$route['admin/doDeleteCountry/(:any)'] = "admin/country/doDeleteCountry/$1";

//Cities
$route['admin/city'] = 'admin/country/city';
$route['admin/city/(:any)'] = 'admin/country/city/$1';
$route['admin/cities-wrapper'] = 'admin/country/cities-wrapper';
$route['admin/doAddCities'] = 'admin/country/doAddCities';
$route['admin/changeCitiesStatus/(:any)/(:any)'] = 'admin/country/changeCitiesStatus/$1/$2';
$route['admin/doEditCities/(:any)'] = 'admin/country/doEditCities/$1';

//Store Review

$route['admin/adminStoreReview'] = "admin/adminStoreReview/index";
$route['admin/get_store_review_wrapper'] = "admin/adminStoreReview/get_store_review_wrapper";
$route['admin/changeStoreReviewStatus/(:any)/(:any)'] = "admin/adminStoreReview/changeStoreReviewStatus/$1/$2";

// Restaurant Review

$route['admin/adminRestaurantReview'] = "admin/adminRestaurantReview/index";
$route['admin/get_restaurant_review_wrapper'] = "admin/adminRestaurantReview/get_restaurant_review_wrapper";
$route['admin/changeRestaurantReviewStatus/(:any)/(:any)'] = "admin/adminRestaurantReview/changeRestaurantReviewStatus/$1/$2";

//Restaurant
$route['admin/adminRestaurant'] = "admin/adminRestaurant/index";
$route['admin/get-admin-restaurant-wrapper'] = "admin/adminRestaurant/get-restaurant-wrapper";
$route['admin/changeAdminRestaurantStatus/(:any)/(:any)'] = "admin/adminRestaurant/changeAdminRestaurantStatus/$1/$2";
$route['admin/changeAdminRestaurantStatusOpenOrClose/(:any)/(:any)'] = "admin/adminRestaurant/changeAdminRestaurantStatusOpenOrClose/$1/$2";
$route['admin/changeAdminRestaurantDeliveryChargeOnOrOff/(:any)/(:any)'] = "admin/adminRestaurant/changeAdminRestaurantDeliveryChargeOnOrOff/$1/$2";
$route['admin/changeAdminRestaurantDeliveryChargeType/(:any)/(:any)'] = "admin/adminRestaurant/changeAdminRestaurantDeliveryChargeType/$1/$2";
$route['admin/addRestaurant'] = "admin/adminRestaurant/addRestaurant";
$route['admin/editRestaurant/(:any)'] = "admin/adminRestaurant/editRestaurant/$1";
$route['partner/addRestaurant/(:any)'] = "admin/adminRestaurant/addRestaurant/$1";
$route['admin/doAddRestaurant'] = "admin/adminRestaurant/doAddRestaurant";
$route['admin/doEditRestaurant/(:any)'] = "admin/adminRestaurant/doEditRestaurant/$1";

// Restaurant Menu Category
$route['admin/restaurant-menu-category/(:any)'] = "admin/adminRestaurant/restaurant-menu-category/$1";
$route['partner/restaurant-menu-category/(:any)'] = "admin/adminRestaurant/restaurant-menu-category/$1";
$route['admin/restaurant-menu-category/(:any)/(:any)'] = "admin/adminRestaurant/restaurant-menu-category/$1/$2";
$route['partner/restaurant-menu-category/(:any)/(:any)'] = "admin/adminRestaurant/restaurant-menu-category/$1/$2";
$route['admin/get-restaurant-menu-category-wrapper/(:any)'] = "admin/adminRestaurant/get-restaurant-menu-category-wrapper/$1";
$route['admin/doAddRestaurantMenuCategory/(:any)'] = "admin/adminRestaurant/doAddRestaurantMenuCategory/$1";
$route['admin/doEditRestaurantMenuCategory/(:any)/(:any)'] = "admin/adminRestaurant/doEditRestaurantMenuCategory/$1/$2";
$route['admin/changeRestaurantMenuCategoryStatus/(:any)/(:any)'] = "admin/adminRestaurant/changeRestaurantMenuCategoryStatus/$1/$2";

//Restaurant Menu 
$route['admin/restaurant-menu/(:any)/(:any)'] = "admin/AdminMenu/restaurant-menu/$1/$2";
$route['admin/get-restaurant-menu-wrapper/(:any)/(:any)'] = "admin/AdminMenu/get-restaurant-menu-wrapper/$1/$2";
$route['admin/add-restaurant-menu/(:any)/(:any)'] = "admin/AdminMenu/add-restaurant-menu/$1/$2";
$route['admin/add-restaurant-menu/(:any)/(:any)/(:any)'] = "admin/AdminMenu/add-restaurant-menu/$1/$2/$3";
$route['partner/add-restaurant-menu/(:any)/(:any)'] = "admin/AdminMenu/add-restaurant-menu/$1/$2";
$route['partner/add-restaurant-menu/(:any)/(:any)/(:any)'] = "admin/AdminMenu/add-restaurant-menu/$1/$2/$3";
$route['admin/doAddRestaurantMenu/(:any)/(:any)'] = "admin/AdminMenu/doAddRestaurantMenu/$1/$2";
$route['admin/doEditRestaurantMenu/(:any)/(:any)/(:any)'] = "admin/AdminMenu/doEditRestaurantMenu/$1/$2/$3";
$route['admin/changeRestaurantMenuStatus/(:any)/(:any)'] = "admin/AdminMenu/changeRestaurantMenuStatus/$1/$2";

//registeredUser
$route['admin/registered-user'] = 'admin/user/index';
$route['admin/get-user-wrapper'] = 'admin/user/get-user-wrapper';
$route['admin/add-registered-user'] = 'admin/user/add-registered-user';
$route['admin/add-registered-user/(:any)'] = 'admin/user/add-registered-user/$1';
$route['admin/doAddUser'] = 'admin/user/doAddUser';
$route['admin/doEditUser/(:any)'] = 'admin/user/doEditUser/$1';
$route['admin/doChangeUserStatus/(:any)/(:any)'] = "admin/user/doChangeUserStatus/$1/$2";
$route['admin/doDeleteUserById/(:any)'] = 'admin/user/doDeleteUserById/$1';
$route['admin/user-change-password/(:any)'] = 'admin/user/user-change-password/$1';

//courier
$route['admin/courierSection'] = "admin/courierSection/index";
$route['admin/get-courier-wrapper'] = "admin/courierSection/get-courier-wrapper";
$route['admin/doEditCourier/(:any)'] = "admin/courierSection/doEditCourier/$1";
$route['admin/addCourier'] = "admin/courierSection/addCourier";
$route['admin/addCourier/(:any)'] = "admin/courierSection/addCourier/$1";
$route['admin/doAddCourier'] = "admin/courierSection/doAddCourier";
$route['admin/doDeleteCourier/(:any)'] = "admin/courierSection/doDeleteCourier/$1";
$route['admin/changeCourierStatus/(:any)/(:any)'] = "admin/courierSection/changeCourierStatus/$1/$2";
$route['admin/courier-change-password/(:any)'] = 'admin/courierSection/courier-change-password/$1';

//courier Application
$route['admin/courier-application'] = "admin/courierSection/courier-application";
$route['admin/get-courier-enquiry-wrapper'] = "admin/courierSection/get-courier-enquiry-wrapper";
$route['admin/viewCourierEnquiry/(:any)'] = "admin/courierSection/viewCourierEnquiry/$1";

//Restaurant Slider
$route['admin/restaurant-slider'] = 'admin/RestaurantSlider/index';
$route['admin/get-slider-wrapper'] = 'admin/RestaurantSlider/get-slider-wrapper';
$route['admin/addSlider'] = 'admin/RestaurantSlider/addSlider';
$route['admin/doAddSlider'] = 'admin/RestaurantSlider/doAddSlider';
$route['admin/doDeleteSlider/(:any)'] = 'admin/RestaurantSlider/doDeleteSlider/$1';
$route['admin/changeSliderStatus/(:any)/(:any)'] = 'admin/RestaurantSlider/changeSliderStatus/$1/$2';

//Market Place Category
$route['admin/market-category'] = 'admin/marketCategory/index';
$route['admin/market-category/(:any)'] = 'admin/marketCategory/index/$1';
$route['admin/doAddMarketPlaceCategory'] = 'admin/marketCategory/doAddMarketPlaceCategory';
$route['admin/get-market-place-category-wrapper'] = 'admin/marketCategory/get-market-place-category-wrapper';
$route['admin/doEditMarketPlaceCategory/(:any)'] = 'admin/marketCategory/doEditMarketPlaceCategory/$1';
$route['admin/changeMarketPlacetCategoryStatus/(:any)/(:any)'] = 'admin/marketCategory/changeMarketPlacetCategoryStatus/$1/$2';

//Market Place Product
$route['admin/adminMarket'] = 'admin/adminMarket/index';
$route['admin/get-market-place-product-wrapper'] = 'admin/adminMarket/get-market-place-product-wrapper';
$route['admin/addMarketProduct'] = 'admin/adminMarket/addProduct';
$route['admin/addMarketProduct/(:any)'] = 'admin/adminMarket/addProduct/$1';
$route['admin/doAddMarketProduct'] = 'admin/adminMarket/doAddProduct';
$route['admin/doEditMarketProduct/(:any)'] = 'admin/adminMarket/doEditProduct/$1';
$route['admin/changeMarketProductStatus/(:any)/(:any)'] = 'admin/adminMarket/changeProductStatus/$1/$2';

//career Job Category
$route['admin/job-category'] = 'admin/jobCategory/index';
$route['admin/job-category/(:any)'] = 'admin/jobCategory/index/$1';
$route['admin/get-job-category-wrapper'] = 'admin/jobCategory/get-job-category-wrapper';
$route['admin/doAddJobCategory'] = 'admin/jobCategory/doAddJobCategory';
$route['admin/doEditJobCategory/(:any)'] = 'admin/jobCategory/doEditJobCategory/$1';
$route['admin/changeJobCategoryStatus/(:any)/(:any)'] = 'admin/jobCategory/changeJobCategoryStatus/$1/$2';

//Career Job Type
$route['admin/job-type'] = 'admin/jobCategory/job-type';
$route['admin/get-job-type-wrapper'] = 'admin/jobCategory/get-job-type-wrapper';
$route['admin/add-job-type'] = 'admin/jobCategory/add-job-type';
$route['admin/add-job-type/(:any)'] = 'admin/jobCategory/add-job-type/$1';
$route['admin/doAddJobType'] = 'admin/jobCategory/doAddJobType';
$route['admin/doEditJobType/(:any)'] = 'admin/jobCategory/doEditJobType/$1';
$route['admin/doDeleteJobType/(:any)'] = 'admin/jobCategory/doDeleteJobType/$1';
$route['admin/changeJobTypeStatus/(:any)/(:any)'] = 'admin/jobCategory/changeJobTypeStatus/$1/$2';

//career Job Detail
$route['admin/job-board'] = 'admin/career/job-board';
$route['admin/get-job-detail-wrapper'] = 'admin/career/get-job-detail-wrapper';
$route['admin/addJobBoardDetail'] = 'admin/career/addJobBoardDetail';
$route['admin/doAddJobDetail'] = 'admin/career/doAddJobDetail';
$route['admin/addJobBoardDetail/(:any)'] = 'admin/career/addJobBoardDetail/$1';
$route['admin/doEditJobDetail/(:any)'] = 'admin/career/doEditJobDetail/$1';
$route['admin/doDeleteJobDetail/(:any)'] = 'admin/career/doDeleteJobDetail/$1';
$route['admin/changeJobDetailStatus/(:any)/(:any)'] = 'admin/career/changeJobDetailStatus/$1/$2';
$route['admin/job-applied'] = 'admin/career/job-applied';


//Partner Store
$route['partner/partnerStore'] = 'admin/partnerStore';
$route['admin/get-partner-store-wrapper'] = 'admin/PartnerStore/get-partner-store-wrapper';
$route['admin/changeStoreStatus/(:any)/(:any)'] = 'admin/PartnerStore/changeStoreStatus/$1/$2';
$route['partner/view-partner-store/(:any)'] = 'admin/PartnerStore/view-partner-store/$1';
$route['admin/doEditPartnerStore/(:any)'] = 'admin/PartnerStore/doEditPartnerStore/$1';
$route['admin/changePartnerRestaurantStatus/(:any)/(:any)'] = 'admin/PartnerStore/changePartnerRestaurantStatus/$1/$2';

//Partner Restaurant
$route['partner/partnerRestaurant'] = 'admin/partnerRestaurant';
$route['admin/get-partner-restaurant-wrapper'] = 'admin/partnerRestaurant/get-partner-restaurant-wrapper';
$route['partner/addPartnerRestaurant/(:any)'] = 'admin/partnerRestaurant/addPartnerRestaurant/$1';
$route['admin/doEditPartnerRestaurant/(:any)'] = 'admin/partnerRestaurant/doEditPartnerRestaurant/$1';
$route['admin/partner-change-password/(:any)'] = 'admin/partnerSection/partnerChangePassword/$1';
$route['admin/changePartnerRestaurantStatus/(:any)/(:any)'] = 'admin/partnerRestaurant/changePartnerRestaurantStatus/$1/$2';

//Partner Restaurant Menu Category
$route['partner/partner-restaurant-menu-category/(:any)'] = 'admin/partnerRestaurant/partner-restaurant-menu-category/$1';
$route['partner/partner-restaurant-menu-category/(:any)/(:any)'] = 'admin/partnerRestaurant/partner-restaurant-menu-category/$1/$2';
$route['partner/get-partner-restaurant-menu-category-wrapper/(:any)'] = 'admin/partnerRestaurant/get-partner-restaurant-menu-category-wrapper/$1';
$route['partner/doEditPartnerRestaurantMenuCategory/(:any)/(:any)'] = 'admin/partnerRestaurant/doEditPartnerRestaurantMenuCategory/$1/$2';
$route['partner/doAddPartnerRestaurantMenuCategory/(:any)'] = 'admin/partnerRestaurant/doAddPartnerRestaurantMenuCategory/$1';
$route['partner/changePartnerRestaurantMenuCategoryStatus/(:any)/(:any)'] = 'admin/partnerRestaurant/changePartnerRestaurantMenuCategoryStatus/$1/$2';

//Partner Restaurant Menu
$route['partner/partner-restaurant-menu/(:any)/(:any)'] = 'admin/partnerRestaurant/partner-restaurant-menu/$1/$2';
$route['partner/get-partner-restaurant-menu-wrapper/(:any)/(:any)'] = 'admin/partnerRestaurant/get-partner-restaurant-menu-wrapper/$1/$2';
$route['partner/add-partner-restaurant-menu/(:any)/(:any)'] = 'admin/partnerRestaurant/add-partner-restaurant-menu/$1/$2';
$route['partner/add-partner-restaurant-menu/(:any)/(:any)/(:any)'] = 'admin/partnerRestaurant/add-partner-restaurant-menu/$1/$2/$3';
$route['partner/doEditPartnerRestaurantMenu/(:any)/(:any)/(:any)'] = 'admin/partnerRestaurant/doEditPartnerRestaurantMenu/$1/$2/$3';
$route['partner/doAddPartnerRestaurantMenu/(:any)/(:any)'] = 'admin/partnerRestaurant/doAddPartnerRestaurantMenu/$1/$2';
$route['partner/changePartnerRestaurantMenuStatus/(:any)/(:any)'] = 'admin/partnerRestaurant/changePartnerRestaurantMenuStatus/$1/$2';

//Coupon Management
$route['admin/coupon'] = 'admin/coupon';
$route['admin/get-coupon-wrapper'] = 'admin/coupon/get-coupon-wrapper';
$route['admin/addCoupon'] = 'admin/coupon/addCoupon';
$route['admin/addCoupon/(:any)'] = 'admin/coupon/addCoupon/$1';
$route['admin/doAddCoupon'] = 'admin/coupon/doAddCoupon';
$route['admin/doEditCoupon/(:any)'] = 'admin/coupon/doEditCoupon/$1';
$route['admin/doDeleteCouponById/(:any)'] = 'admin/coupon/doDeleteCouponById/$1';
$route['admin/doChangeCouponStatus/(:any)/(:any)'] = 'admin/coupon/doChangeCouponStatus/$1/$2';

//Partner Market Place Product
$route['partner/partnerMarket'] = 'admin/partnerMarket';
$route['admin/get-partner-market-place-product-wrapper'] = 'admin/partnerMarket/get-partner-market-place-product-wrapper';
$route['admin/changePartnerProductStatus/(:any)/(:any)'] = 'admin/partnerMarket/changePartnerProductStatus/$1/$2';
$route['partner/addPartnerProduct'] = 'admin/partnerMarket/addPartnerProduct';
$route['partner/addPartnerProduct/(:any)'] = 'admin/partnerMarket/addPartnerProduct/$1';
$route['admin/doEditPartnerProduct/(:any)'] = 'admin/partnerMarket/doEditPartnerProduct/$1';
$route['admin/doAddPartnerProduct'] = 'admin/partnerMarket/doAddPartnerProduct';
$route['admin/doDeletePartnerProduct/(:any)'] = 'admin/partnerMarket/doDeletePartnerProduct/$1';

//site content Privacy and Terms
$route['admin/terms-condition'] = 'admin/site_content/terms-condition';
$route['admin/addTermsPageContent'] = 'admin/site_content/addTermsPageContent';
$route['admin/editTermsPageContent/(:any)'] = 'admin/site_content/editTermsPageContent/$1';
$route['admin/privacy_policy'] = 'admin/site_content/privacy_policy';
$route['admin/addPrivacyPageContent'] = 'admin/site_content/addPrivacyPageContent';
$route['admin/editPrivacyPageContent/(:any)'] = 'admin/site_content/editPrivacyPageContent/$1';

//Help category
$route['admin/help'] = 'admin/site_content/help';
$route['admin/get-help-category-wrapper'] = 'admin/site_content/get-help-category-wrapper';
$route['admin/addHelpCategory'] = 'admin/site_content/addHelpCategory'; 
$route['admin/addHelpCategory/(:any)'] = 'admin/site_content/addHelpCategory/$1';
$route['admin/doAddHelpCategory'] = 'admin/site_content/doAddHelpCategory';
$route['admin/doEditHelpCategory/(:any)'] = 'admin/site_content/doEditHelpCategory/$1';
$route['admin/doChangeHelpCategoryStatus/(:any)/(:any)'] = 'admin/site_content/doChangeHelpCategoryStatus/$1/$2';

//Site Content Help Category
$route['admin/helpContent/(:any)'] = 'admin/site_content/helpContent/$1';
$route['admin/addHelpPageContent/(:any)'] = 'admin/site_content/addHelpPageContent/$1';
$route['admin/editHelpPageContent/(:any)'] = 'admin/site_content/editHelpPageContent/$1';

//Partner Shop Section
$route['partner/partner-shop-section'] = 'admin/PartnerStore/partner-shop-section';
$route['partner/partner-shop-section/(:any)'] = 'admin/PartnerStore/partner-shop-section/$1';
$route['partner/get-partner-shop-section-wrapper'] = 'admin/PartnerStore/get-partner-shop-section-wrapper';
$route['partner/changePartnerShopSectionStatus/(:any)/(:any)'] = 'admin/PartnerStore/changePartnerShopSectionStatus/$1/$2';
$route['partner/doEditPartnerShopSection/(:any)'] = 'admin/PartnerStore/doEditPartnerShopSection/$1';
$route['partner/doAddPartnerShopSection'] = 'admin/PartnerStore/doAddPartnerShopSection';

//partner add product
$route['partner/partnerProduct/(:any)/(:any)'] = 'admin/partnerProduct/index/$1/$2';
$route['partner/get-product-wrapper/(:any)/(:any)'] = 'admin/partnerProduct/get-product-wrapper/$1/$2';
$route['partner/add-product/(:any)/(:any)'] = "admin/partnerProduct/add-product/$1/$2";
$route['partner/add-product/(:any)/(:any)/(:any)'] = "admin/partnerProduct/add-product/$1/$2/$3";
$route['partner/doAddProduct/(:any)/(:any)'] = "admin/partnerProduct/doAddProduct/$1/$2";
$route['partner/doEditProduct/(:any)/(:any)/(:any)'] = "admin/partnerProduct/doEditProduct/$1/$2/$3";
$route['partner/changeProductStatus/(:any)/(:any)'] = "admin/partnerProduct/changeProductStatus/$1/$2";
$route['partner/removeProductGroupMapping/(:any)'] = "admin/partnerProduct/removeProductGroupMapping/$1";

//Partner Product Sku
$route['partner/view-product-sku/(:any)/(:any)/(:any)'] = "admin/partnerProduct/view-product-sku/$1/$2/$3";
$route['partner/get-product-sku-wrapper/(:any)/(:any)/(:any)'] = "admin/partnerProduct/get-product-sku-wrapper/$1/$2/$3";
$route['partner/add-product-sku/(:any)/(:any)/(:any)'] = "admin/partnerProduct/add-product-sku/$1/$2/$3";
$route['partner/doAddProductSku/(:any)/(:any)/(:any)'] = "admin/partnerProduct/doAddProductSku/$1/$2/$3";
$route['partner/add-product-sku/(:any)/(:any)/(:any)/(:any)'] = "admin/partnerProduct/add-product-sku/$1/$2/$3/$4";
$route['partner/get-product-sku-image-wrapper/(:any)'] = "admin/partnerProduct/get-product-sku-image-wrapper/$1";
$route['partner/doDeleteProductSkuImage/(:any)'] = "admin/partnerProduct/doDeleteProductSkuImage/$1";
$route['partner/doEditProductSku/(:any)/(:any)/(:any)/(:any)'] = "admin/partnerProduct/doEditProductSku/$1/$2/$3/$4";
$route['partner/changeProductSkuStatus/(:any)/(:any)'] = "admin/partnerProduct/changeProductSkuStatus/$1/$2";


//Gift card Amount Routing
$route['admin/purchased_gift_card'] = "admin/giftCard/purchased_gift_card";
$route['admin/get-gift-card-amount-wrapper'] = "admin/giftCard/get-gift-card-amount-wrapper";
$route['admin/doAddGiftCardAmount'] = 'admin/giftCard/doAddGiftCardAmount';
$route['admin/doEditGiftCardAmount/(:any)'] = 'admin/giftCard/doEditGiftCardAmount/$1';
$route['admin/doDeleteAmountById/(:any)'] = 'admin/giftCard/doDeleteAmountById/$1';
$route['admin/doChangeAmountStatus/(:any)/(:any)'] = 'admin/giftCard/doChangeAmountStatus/$1/$2';

//Gift card routing
$route['admin/purchased-gift-card'] = 'admin/giftCard/purchased-gift-card';
$route['admin/get-gift-card-wrapper'] = 'admin/giftCard/get-gift-card-wrapper';
$route['admin/doDeleteGiftCard/(:any)'] = 'admin/giftCard/doDeleteGiftCard/$1';

//Store Slider
$route['admin/store-slider'] = 'admin/adminStore/store-slider';
$route['admin/get-store-slider-wrapper'] = 'admin/adminStore/get-store-slider-wrapper';
$route['admin/addStoreSlider'] = 'admin/adminStore/addStoreSlider';
$route['admin/doAddStoreSlider'] = 'admin/adminStore/doAddStoreSlider';
$route['admin/doDeleteStoreSlider/(:any)'] = 'admin/adminStore/doDeleteStoreSlider/$1';
$route['admin/changeStoreSliderStatus/(:any)/(:any)'] = 'admin/adminStore/changeStoreSliderStatus/$1/$2';

// Partner Order Management
$route['admin/partnerOrder'] = 'admin/partnerOrder';
$route['admin/get-partner-restaurant-order-wrapper'] = 'admin/partnerOrder/get-partner-restaurant-order-wrapper';
$route['partner/viewOrderDetail/(:any)/(:any)'] = 'admin/partnerOrder/viewOrderDetail/$1/$2';
$route['partnerorder/updateOrderStatus/(:any)'] = 'admin/partnerOrder/updateOrderStatus/$1';
$route['partnerorder/allotOrderToCourier/(:any)'] = 'admin/partnerOrder/allotOrderToCourier/$1';
$route['partnerorder/outForDelivery/(:any)'] = 'admin/partnerOrder/outForDelivery/$1';
$route['partnerOrder/getCourierStatusWrapper/(:any)'] = 'admin/partnerOrder/getCourierStatusWrapper/$1';
$route['partnerOrder/checkForCourierConfirmation/(:any)'] = 'admin/partnerOrder/checkForCourierConfirmation/$1';
$route['partnerOrder/store-order'] = 'admin/partnerOrder/store-order';
$route['partnerOrder/get-partner-store-order-wrapper'] = 'admin/partnerOrder/get-partner-store-order-wrapper';
$route['partnerOrder/viewStoreOrderDetail/(:any)'] = 'admin/partnerOrder/viewStoreOrderDetail/$1';

$route['partnerOrder/order-cancel-reason/(:any)'] = 'admin/partnerOrder/order-cancel-reason/$1';
$route['partnerOrder/order-prepared-time/(:any)'] = 'admin/partnerOrder/order-prepared-time/$1';
$route['partnerOrder/store-order'] = 'admin/partnerOrder/store-order';
$route['partnerOrder/get-partner-store-order-wrapper'] = 'admin/partnerOrder/get-partner-store-order-wrapper';
$route['partnerOrder/viewStoreOrderDetail/(:any)'] = 'admin/partnerOrder/viewStoreOrderDetail/$1';


// Courier Order Management
$route['admin/courier'] = 'admin/courier';
$route['admin/get-courier-restaurant-order-wrapper'] = 'admin/courier/get-courier-restaurant-order-wrapper';
$route['courier/courierOrderDetail/(:any)'] = 'admin/courier/courierOrderDetail/$1';
$route['courier/courierOrderDetail/(:any)/(:any)'] = 'admin/courier/courierOrderDetail/$1/$2';
$route['courier/updateOrderStatus/(:any)'] = 'admin/courier/updateOrderStatus/$1';
$route['courier/allotOrderToCourier/(:any)'] = 'admin/courier/allotOrderToCourier/$1';
$route['courier/updateCourierAvailableStatus/(:any)/(:any)/(:any)'] = 'admin/courier/updateCourierAvailableStatus/$1/$2/$3';
$route['courier/view-order'] = "admin/courier/view-order";
$route['courier/updateCourierDeliveryStatus/(:any)/(:any)'] = 'admin/courier/updateCourierDeliveryStatus/$1/$2';
$route['courier/update-courier-notification-wrapper'] = 'admin/courier/update-courier-notification-wrapper';
$route['courier/updateOrderReceivedStatus/(:any)/(:any)'] ='admin/courier/updateOrderReceivedStatus/$1/$2';
$route['courier/get-notification'] ='admin/courier/get-notification';
$route['courier/get-courier-wrapper/(:any)'] ='admin/courier/get-courier-wrapper/$1';
$route['courier/check-for-accept-order/(:any)'] ='admin/courier/check-for-accept-order/$1';
$route['courier/getAddress/(:any)'] = 'admin/courier/getAddress/$1';
$route['courier/getRestaurantAddress/(:any)'] = 'admin/courier/getRestaurantAddress/$1';
$route['courier/getuserAddress/(:any)'] = 'admin/courier/getuserAddress/$1';
$route['courier/orderDelivered/(:any)'] = 'admin/courier/orderDelivered/$1';
$route['admin/search-for-order'] = 'admin/courier/search-for-order';

//Admin restaurant Order Management
$route['admin/restaurant-orders'] = 'admin/admin/restaurant-orders';
$route['admin/get-admin-restaurant-order-wrapper'] = 'admin/admin/get-admin-restaurant-order-wrapper';
$route['admin/viewOrderDetail/(:any)/(:any)'] = 'admin/admin/viewOrderDetail/$1/$2';

//Admin Store Order Management
$route['admin/store-orders'] = 'admin/admin/store-orders';
$route['admin/get-admin-store-order-wrapper'] = 'admin/admin/get-admin-store-order-wrapper';
$route['admin/viewStoreOrderDetail/(:any)'] = 'admin/admin/viewStoreOrderDetail/$1';

//Admin restaurant delivered Order Management
$route['admin/restaurant-delivered-orders'] = 'admin/admin/restaurant-delivered-orders';
$route['admin/get-admin-restaurant-delivered-order-wrapper'] = 'admin/admin/get-admin-restaurant-delivered-order-wrapper';
$route['admin/viewDeliveredOrderDetail/(:any)/(:any)'] = 'admin/admin/viewDeliveredOrderDetail/$1/$2';

//Admin restaurant cancel Order Management
$route['admin/get-admin-restaurant-cancel-order-wrapper'] = 'admin/admin/get-admin-restaurant-cancel-order-wrapper';

//Front End Routing

// Restaurant
$route['restaurant/get-restaurant-wrapper'] = "restaurant/get-restaurant-wrapper";
$route['restaurant/addToCartMenu'] = "restaurant/addToCartMenu";
$route['restaurant/removeFromCart/(:any)'] = "restaurant/removeFromCart/$1";
$route['restaurant/get-order-wrapper'] = "restaurant/get-order-wrapper";
$route['restaurant/get-special-menu-wrapper'] = "restaurant/get-special-menu-wrapper";
$route['restaurant/applyCoupon'] = "restaurant/applyCoupon";
$route['restaurant/removeCoupon'] = "restaurant/removeCoupon";
$route['restaurant/do-add-address'] = "restaurant/doadd_address_details";
$route['restaurant/do-payment'] = "restaurant/do_final_payment";
$route['restaurant/apply-tips/(:any)'] = "restaurant/apply_tip/$1";
$route['restaurant/checkout/(:any)'] = "restaurant/checkout_continue/$1";
$route['restaurant/delivery/(:any)'] = "restaurant/checkout_details/$1";
$route['restaurant/payment/(:any)'] = "restaurant/payment_details/$1";
$route['restaurant/do-secure-stripe-payment/(:any)'] = "restaurant/stripe_payment/$1";
$route['restaurant/cash-on-delivery/(:any)'] = "restaurant/cash_on_delivery/$1";
$route['restaurant/order-detail/(:any)'] = "restaurant/order_detail_submit/$1";
$route['restaurant/payment-success/(:any)'] = "restaurant/success_order/$1";
$route['restaurant/(:any)'] = "restaurant/restaurant/$1";

// User Routing
$route['user/login'] = ['user/login'];
$rount['user/register'] = ['user/registerForm'];
$route['user/my-account'] = 'user/myaccount';
$route['user/chnage-password'] = 'user/changePassword';
$rount['user/forgot-password'] = 'user/forgot_password';
$route['user/profile-upload'] = 'user/accountupload';
$rount['user/order-history'] = 'user/order_history';
$rount['user/my-account-wrapper'] = 'user/my_account_wrapper';
$rount['user/profile-upload-wrapper'] = 'user/profile_upload_wrapper';
$rount['user/order-history-wrapper'] = 'user/order_history_wrapper';
$rount['user/change-password-wrapper'] = 'user/change_password_wrapper';
$rount['user/password-reset-link'] = 'user/password_reset_link';
$rout['user/password-reset/(:any)/(:any)'] = 'user/password_reset/$1/$2';
 

// Store
$route['store/get-store-wrapper'] = "store/get-store-wrapper";
$route['store/addToCartStore'] = "store/addToCartStore";
$route['store/doAddReview'] = "store/doAddReview";
$route['store/changeSku'] = "store/changeSku";
$route['store/(:any)'] = "store/store/$1";
$route['product/(:any)'] = "store/product/$1";

// cart

$route['delivery'] = "cart/delivery";
$route['payment'] = "cart/payment";

// Market Place
$route['marketPlace/(:any)'] = "marketPlace/index/$1";


//Career
$route['career'] = 'site/career';
$route['career-detail/(:any)'] = 'site/career-detail/$1';

//gift card
$route['confirm-order'] = 'payments/confirm-order';
$route['gift-card'] = 'site/gift-card';

