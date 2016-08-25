<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');
/*
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
*/
Route::post('admin/login', 'LoginController@loginverify');
Route::post('admin/forgot_password', 'LoginController@forgot_password');
Route::post('admin/check_user_password', 'LoginController@check_user_password');
Route::post('admin/change_password', 'LoginController@change_password');
Route::get('auth/session', 'LoginController@check_session');
Route::get('auth/logout', 'LoginController@logout');

// COMPANY ROUTERS
Route::get('admin/company', 'CompanyController@listData');
Route::post('admin/company/list', 'CompanyController@listData');
Route::post('admin/company/add', 'CompanyController@addData');
Route::get('admin/company/edit/{id}/{company_id}', 'CompanyController@GetData');
Route::post('admin/company/save', 'CompanyController@SaveData');
Route::post('admin/company/delete', 'CompanyController@DeleteData');
Route::post('admin/company/change_password', 'CompanyController@change_password');
Route::get('admin/company/getCompanyInfo/{company_id}', 'CompanyController@getCompanyInfo');
Route::get('admin/company/getAffiliate/{company_id}/{affiliate_id}', 'CompanyController@getAffiliate');
Route::post('admin/company/addAffilite', 'CompanyController@addAffilite');
Route::post('admin/company/UpdateAffilite', 'CompanyController@UpdateAffilite');
Route::get('admin/company/getAuthorizeAPI/{company_id}', 'CompanyController@getAuthorizeAPI');
Route::get('admin/company/getUpsAPI/{company_id}', 'CompanyController@getUpsAPI');
Route::get('admin/company/getSnsAPI/{company_id}', 'CompanyController@getSnsAPI');
Route::get('admin/company/getQBAPI/{company_id}', 'CompanyController@getQBAPI');

// COMPANY USERS ROUTERS
Route::get('admin/account', 'AccountController@listData');
Route::get('admin/account/list/{parent_id}', 'AccountController@listData');
Route::post('admin/account/add', 'AccountController@addData');
Route::get('admin/account/edit/{id}/{parent}', 'AccountController@GetData');
Route::post('admin/account/save', 'AccountController@SaveData');
Route::post('admin/account/delete', 'AccountController@DeleteData');
Route::post('admin/account/ResetPasswordMail', 'AccountController@ResetPasswordMail');

// ADMIN STAFF ROUTERS
Route::post('admin/staff', 'StaffController@index');
Route::post('admin/staffAdd', 'StaffController@add');
Route::post('admin/staffEdit', 'StaffController@edit');
Route::post('admin/staffDelete', 'StaffController@delete');
Route::post('admin/staffDetail', 'StaffController@detail');
Route::get('admin/StaffEdit/{id}', 'StaffController@detail');
Route::post('admin/staffNoteTimeoff', 'StaffController@staffNoteTimeoff');

// ADMIN NOTE ROUTERS
Route::post('admin/staff/note', 'StaffController@note');
Route::post('admin/staff/noteDelete', 'StaffController@noteDelete');
Route::post('admin/staff/noteAdd', 'StaffController@noteAdd');
Route::post('admin/staff/noteEdit', 'StaffController@noteEdit');
Route::post('admin/staff/noteDetail', 'StaffController@notedetail');

// ADMIN TIME OFF ROUTERS
Route::post('admin/staff/timeoff', 'StaffController@timeoff');
Route::post('admin/staff/timeoffDelete', 'StaffController@timeoffDelete');
Route::post('admin/staff/timeoffAdd', 'StaffController@timeoffAdd');
Route::post('admin/staff/timeoffEdit', 'StaffController@timeoffEdit');
Route::post('admin/staff/timeoffDetail', 'StaffController@timeoffdetail');


// ADMIN Vendor ROUTERS
Route::post('admin/vendor', 'VendorController@index');
Route::post('admin/vendorDelete', 'VendorController@delete');
Route::post('admin/vendorAdd', 'VendorController@add');
Route::post('admin/vendorEdit', 'VendorController@edit');
Route::post('admin/vendorDetail', 'VendorController@detail');
Route::get('admin/VendorEdit/{id}', 'VendorController@detail');
Route::post('admin/productVendor', 'VendorController@productVendor');

// ADMIN PRODUCT ROUTERS
Route::post('admin/product', 'ProductController@index');
Route::post('admin/productAdd', 'ProductController@add');
Route::post('admin/productDelete', 'ProductController@delete');
Route::post('admin/productDetail', 'ProductController@detail');


// ADMIN SETTING ROUTERS
Route::post('admin/price', 'SettingController@price');
Route::post('admin/priceDelete', 'SettingController@delete');
Route::post('admin/priceGridDuplicate', 'SettingController@priceGridDuplicate');
Route::post('admin/priceEdit', 'SettingController@priceEdit');
Route::post('admin/priceDetail', 'SettingController@priceDetail');
Route::get('admin/priceEdit/{id}', 'SettingController@priceDetail');
Route::post('admin/priceGridPrimaryDuplicate', 'SettingController@priceGridPrimaryDuplicate');
Route::post('admin/priceSecondary', 'SettingController@priceSecondary');
Route::post('admin/downloadPricegridCSV', 'SettingController@downloadPricegridCSV');
Route::post('admin/uploadPricingCSV', 'SettingController@uploadPricingCSV');
Route::get('admin/uploadSnsCSV', 'SettingController@uploadSnsCSV');

// ADMIN MISC ROUTERS
Route::post('admin/miscSave', 'MiscController@miscSave');
Route::post('admin/placementSave', 'SettingController@placementSave');
Route::post('admin/colorSave', 'SettingController@colorSave');
Route::post('admin/colorInsert', 'SettingController@colorInsert');



// COMMON CONTROLLER 
Route::get('common/getAdminRoles', 'CommonController@getAdminRoles');
Route::get('common/type/{type}', 'CommonController@type');
Route::get('common/staffRole', 'CommonController@getStaffRoles');
Route::get('common/checkemail/{email}/{userid}', 'CommonController@checkemailExist');
Route::post('auth/company', 'CommonController@CompanyService');
Route::get('common/getAllVendors/{id}', 'CommonController@getAllVendors');
Route::post('common/getAllMiscData', 'CommonController@getAllMiscData');
Route::post('common/getAllMiscDataWithoutBlank', 'CommonController@getAllMiscDataWithoutBlank');
Route::get('common/GetMicType/{type}', 'CommonController@GetMicType');
Route::get('common/getStaffList/{id}', 'CommonController@getStaffList');
Route::post('common/getAllPlacementData', 'CommonController@getAllPlacementData');
Route::post('common/getMiscData', 'CommonController@getMiscData');
Route::get('common/getAllColorData', 'CommonController@getAllColorData');
Route::post('common/getCompanyDetail', 'CommonController@getCompanyDetail');
Route::post('common/SaveImage', 'CommonController@SaveImage');
Route::post('common/InsertRecords', 'CommonController@InsertRecords'); // INSERT RECORD FOR ANY TABLE, @PARAMS: TABLE,POST ARRAY.
Route::post('common/GetTableRecords', 'CommonController@GetTableRecords'); // GET RECORD FOR ANY SINGLE TABLE, @PARAMS: TABLE,COND ARRAY.
Route::post('common/UpdateTableRecords', 'CommonController@UpdateTableRecords'); // UPDATE RECORD FOR ANY TABLE, @PARAMS: TABLE,COND, POST ARRAY.
Route::post('common/DeleteTableRecords', 'CommonController@DeleteTableRecords'); // DELETE RECORD FOR ANY TABLE, @PARAMS: TABLE,COND, POST ARRAY.
Route::get('common/getBrandCo', 'CommonController@getBrandCo');
Route::post('common/updatedate', 'CommonController@UpdateDate'); // ONLY UPDATE THE IMAGE IN MYSQL DATE FORMAT.
Route::post('common/InsertUserRecords', 'CommonController@InsertUserRecords'); // INSERT RECORD FOR ANY TABLE, @PARAMS: TABLE,POST ARRAY.
Route::post('common/deleteImage', 'CommonController@deleteImage'); //Update Image
Route::post('common/updateRecordsEmailVal', 'CommonController@updateRecordsEmailVal'); // UPDATE RECORD FOR ANY TABLE, @PARAMS: TABLE,COND, POST ARRAY.
Route::post('common/insertRecordsEmail', 'CommonController@insertRecordsEmail'); // INSERT RECORD FOR ANY TABLE, @PARAMS: TABLE,POST ARRAY.
Route::post('common/allColor', 'CommonController@allColor'); // GET RECORD FOR ANY SINGLE TABLE, @PARAMS: TABLE,COND ARRAY.
Route::post('common/getTestyRecords', 'CommonController@getTestyRecords'); // GET RECORDS WITH PAGINATION PARAMETERS.

// CLIENT CONTROLLER 
Route::post('client/addclient', 'ClientController@addclient');
Route::post('client/ListClient', 'ClientController@ListClient');
Route::post('client/getClientFilterData', 'ClientController@getClientFilterData');
Route::post('client/DeleteClient', 'ClientController@DeleteClient');
Route::post('client/ClientContacts', 'ClientController@ClientContacts');
Route::post('client/getContacts', 'ClientController@getContacts');
Route::post('client/ClientAddress', 'ClientController@ClientAddress');
Route::post('client/getAddress', 'ClientController@getAddress');
Route::post('client/GetclientDetail','ClientController@GetclientDetail');
Route::post('client/SaveSalesDetails', 'ClientController@SaveSalesDetails');
Route::post('client/SaveCleintDetails', 'ClientController@SaveCleintDetails');
Route::post('client/SaveCleintTax', 'ClientController@SaveCleintTax');
Route::post('client/SaveCleintPlimp', 'ClientController@SaveCleintPlimp');
Route::post('client/checkCompName', 'ClientController@checkCompName');
Route::get('client/getDocument/{id}/{company_id}','ClientController@getDocument');
Route::get('client/getDocumentDetailbyId/{id}/{company_id}', 'ClientController@getDocumentDetailbyId');
Route::post('client/updateDoc', 'ClientController@updateDoc');
Route::post('client/saveDoc', 'ClientController@saveDoc');
Route::get('client/deleteClientDoc/{id}', 'ClientController@deleteClientDoc');
Route::get('client/SelectionData/{id}', 'ClientController@SelectionData');
Route::post('client/saveTaxDoc', 'ClientController@saveTaxDoc');


Route::get('client/GetNoteDetails/{id}', 'ClientController@GetNoteDetails');
Route::post('client/SaveCleintNotes', 'ClientController@SaveCleintNotes');
Route::get('client/EditCleintNotes/{id}', 'ClientController@EditCleintNotes');
Route::get('client/DeleteCleintNotes/{id}', 'ClientController@DeleteCleintNotes');
Route::get('client/GetClientDetailById/{id}', 'ClientController@GetClientDetailById');
Route::post('client/UpdateCleintNotes', 'ClientController@UpdateCleintNotes');
Route::post('client/SaveDistAddress', 'ClientController@SaveDistAddress');
Route::post('client/getDistAdressDetail', 'ClientController@getDistAdressDetail');

//PURCHASE CONTROLLER
Route::post('purchase/ListPurchase', 'PurchaseController@ListPurchase');
Route::get('purchase/GetPodata/{id}/{company_id}', 'PurchaseController@GetPodata');
Route::get('purchase/ChangeOrderStatus/{id}/{value}/{po_id}', 'PurchaseController@ChangeOrderStatus');
Route::post('purchase/EditOrderLine', 'PurchaseController@EditOrderLine');
Route::post('purchase/Receive_order', 'PurchaseController@Receive_order');
Route::post('purchase/Update_shiftlock', 'PurchaseController@Update_shiftlock');
Route::get('purchase/short_over/{id}', 'PurchaseController@short_over');
Route::get('purchase/GetScreendata/{id}/{company_id}', 'PurchaseController@GetScreendata');
Route::post('purchase/EditScreenLine', 'PurchaseController@EditScreenLine');
Route::post('purchase/getPurchaseNote/{id}', 'PurchaseController@getPurchaseNote');
Route::post('purchase/createPDF', 'PurchaseController@createPDF');
Route::post('purchase/createPO', 'PurchaseController@createPO');
Route::get('purchase/GetPoReceived/{id}/{company_id}', 'PurchaseController@GetPoReceived');


// ORDER CONTROLLER 
Route::post('order/listOrder', 'OrderController@listOrder');
Route::post('order/deleteOrder', 'OrderController@deleteOrder');
Route::post('order/orderAdd', 'OrderController@add');
Route::post('order/orderEdit', 'OrderController@edit');
Route::post('order/orderDetail', 'OrderController@orderDetail');
Route::get('order/getOrderNoteDetails/{id}','OrderController@getOrderNoteDetails');
Route::get('order/getOrderDetailById/{id}', 'OrderController@getOrderDetailById');
Route::post('order/updateOrderNotes', 'OrderController@updateOrderNotes');
Route::post('order/saveOrderNotes', 'OrderController@saveOrderNotes');
Route::get('order/deleteOrderNotes/{id}', 'OrderController@deleteOrderNotes');
Route::post('order/orderLineAdd', 'OrderController@orderLineadd');
Route::post('order/orderLineUpdate', 'OrderController@orderLineUpdate');
Route::post('order/deleteOrderLine', 'OrderController@deleteOrderLine');
Route::post('order/saveButtonData', 'OrderController@saveButtonData');
Route::post('order/insertPositions', 'OrderController@insertPositions'); // INSERT RECORD FOR ANY TABLE, @PARAMS: TABLE,POST ARRAY.
Route::post('order/updatePositions', 'OrderController@updatePositions'); // UPDATE RECORD FOR ANY TABLE, @PARAMS: TABLE,COND, POST ARRAY.
Route::post('order/deleteOrderCommon', 'OrderController@deleteOrderCommon');
Route::post('order/PODetail', 'OrderController@PODetail');
Route::post('order/updateOrderTask', 'OrderController@updateOrderTask');
Route::post('order/updateDistributedQty', 'OrderController@updateDistributedQty');
Route::post('order/duplicatePoData', 'OrderController@duplicatePoData');
Route::post('order/getTaskDetails', 'OrderController@getTaskDetails');
Route::post('order/getTaskList', 'OrderController@getTaskList');
Route::post('order/saveColorSize', 'OrderController@saveColorSize');
Route::get('order/getProductDetailColorSize/{id}','OrderController@getProductDetailColorSize');
Route::post('order/savePDF', 'OrderController@savePDF');
Route::post('order/AssignSize', 'OrderController@AssignSize');
Route::post('order/productDetail', 'OrderController@productDetail');
Route::post('order/updatePriceProduct', 'OrderController@updatePriceProduct');
Route::post('order/deleteColorSize', 'OrderController@deleteColorSize');
Route::post('order/sendEmail', 'OrderController@sendEmail');
Route::post('order/getOrderPositionDetail', 'OrderController@getOrderPositionDetail');
Route::post('order/getOrderLineDetail', 'OrderController@getOrderLineDetail');
Route::post('order/orderImageDetail', 'OrderController@orderImageDetail');
Route::post('order/addOrder', 'OrderController@addOrder');
Route::post('order/addDesign', 'OrderController@addDesign');
Route::post('order/designListing', 'OrderController@designListing');
Route::post('order/designDetail', 'OrderController@designDetail');
Route::post('order/editDesign', 'OrderController@editDesign');
Route::post('order/getDesignPositionDetail', 'OrderController@getDesignPositionDetail');
Route::post('order/editOrder', 'OrderController@editOrder');
Route::post('order/orderDetailInfo', 'OrderController@orderDetailInfo');
Route::post('order/updateOrderCharge', 'OrderController@updateOrderCharge');
Route::post('order/updateMarkup', 'OrderController@updateMarkup');
Route::post('order/updateOverride', 'OrderController@updateOverride');
Route::get('order/calculateAll/{order_id}/{company_id}', 'OrderController@calculateAll');
Route::post('order/snsOrder', 'OrderController@snsOrder');
Route::post('order/addPosition', 'OrderController@addPosition');
Route::post('order/addInvoice', 'OrderController@addInvoice');
Route::post('order/createInvoice', 'OrderController@createInvoice');


// FINISHING CONTROLLER 
Route::get('finishing/listFinishing', 'FinishingController@listFinishing');
Route::post('finishing/listFinishing', 'FinishingController@listFinishing');
Route::post('finishing/deleteFinishing', 'FinishingController@deleteFinishing');
Route::post('finishing/updateFinishing', 'FinishingController@updateFinishing');
Route::post('finishing/removeFinishingItem', 'FinishingController@removeFinishingItem');
Route::post('finishing/addFinishingItem', 'FinishingController@addFinishingItem');
Route::post('finishing/orderAdd', 'FinishingController@add');
Route::post('finishing/orderEdit', 'FinishingController@edit');
Route::post('finishing/addRemoveToFinishing', 'FinishingController@addRemoveToFinishing');

// SHIPPING CONTROLLER
Route::get('shipping/listShipping', 'ShippingController@listShipping');
Route::post('shipping/listShipping', 'ShippingController@listShipping');
Route::post('shipping/shippingDetail', 'ShippingController@shippingDetail');
Route::post('shipping/getShippingOrders', 'ShippingController@getShippingOrders');
Route::post('shipping/CreateBoxShipment', 'ShippingController@CreateBoxShipment');
Route::post('shipping/updateShipping', 'ShippingController@updateShipping');
Route::post('shipping/DeleteBox', 'ShippingController@DeleteBox');
Route::post('shipping/addShippingItem', 'ShippingController@addShippingItem');
Route::post('shipping/getBoxItems', 'ShippingController@getBoxItems');
Route::post('shipping/createPDF', 'ShippingController@createPDF');
Route::post('shipping/addRemoveAddressToPdf', 'ShippingController@addRemoveAddressToPdf');
Route::get('shipping/addressValidate', 'ShippingController@addressValidate');
Route::post('shipping/shipOrder', 'ShippingController@shipOrder');
Route::post('shipping/getProductByAddress', 'ShippingController@getProductByAddress');
Route::post('shipping/addProductToShip', 'ShippingController@addProductToShip');
Route::post('shipping/getShippingAddress', 'ShippingController@getShippingAddress');
Route::post('shipping/getShippingBoxes', 'ShippingController@getShippingBoxes');
Route::post('shipping/getShippingOverview', 'ShippingController@getShippingOverview');
Route::post('shipping/createLabel', 'ShippingController@createLabel');
Route::post('shipping/checkAddressValid', 'ShippingController@checkAddressValid');


// PRODUCT CONTROLLER
Route::post('product/getProductByVendor', 'ProductController@getProductByVendor');
Route::post('product/getProductCountByVendor', 'ProductController@getProductCountByVendor');
Route::post('product/productDetailData', 'ProductController@productDetailData');
Route::post('product/addProduct', 'ProductController@addProduct');
Route::post('product/designProduct', 'ProductController@designProduct');
Route::post('product/deleteAddProduct', 'ProductController@deleteAddProduct');
Route::post('product/getCustomProduct', 'ProductController@getCustomProduct');
Route::post('product/uploadCSV', 'ProductController@uploadCSV');
Route::post('product/getProductDetailColorSize', 'ProductController@getProductDetailColorSize');
Route::post('product/addcolorsize', 'ProductController@addcolorsize');
Route::post('product/deleteSizeLink', 'ProductController@deleteSizeLink');
Route::post('product/downloadCSV', 'ProductController@downloadCSV');
Route::post('product/checkSnsAuth', 'ProductController@checkSnsAuth');
Route::post('product/getVendorByProductCount', 'ProductController@getVendorByProductCount');
Route::post('product/getProductSize', 'ProductController@getProductSize');
Route::post('product/checkProductExist', 'ProductController@checkProductExist');
Route::post('product/findTotal', 'ProductController@findTotal');

// API CONTROLLER
Route::get('api/GetCompanyApi/{company_id}', 'ApiController@GetCompanyApi');
Route::post('api/getApiData', 'ApiController@getApiData');
Route::post('api/save_SnsApi', 'ApiController@save_api');
Route::post('api/checkApi','ApiController@checkApi');

// ART CONTROLLER
Route::get('art/listing/{company_id}', 'ArtController@listing');
Route::get('art/Art_detail/{art_id}/{company_id}', 'ArtController@Art_detail');
Route::get('art/artworkproof_data/{orderline_id}/{company_id}', 'ArtController@artworkproof_data');
Route::get('art/artjob_screen_list/{art_id}/{company_id}', 'ArtController@artjob_screen_list');
Route::get('art/artjobgroup_list/{art_id}/{company_id}', 'ArtController@artjobgroup_list');
Route::post('art/artjob_screen_add', 'ArtController@artjob_screen_add');
Route::post('art/update_orderScreen', 'ArtController@update_orderScreen');
Route::post('art/ScreenSets', 'ArtController@ScreenSets');
Route::post('art/create_screen', 'ArtController@create_screen');
Route::post('art/DeleteScreenRecord', 'ArtController@DeleteScreenRecord');
Route::post('art/SaveArtWorkProof', 'ArtController@SaveArtWorkProof');
Route::get('art/Insert_artworkproof/{line_id}', 'ArtController@Insert_artworkproof');
Route::get('art/Client_art_screen/{client_id}/{company_id}', 'ArtController@Client_art_screen');
Route::get('art/screen_colorpopup/{screen_id}/{company_id}', 'ArtController@screen_colorpopup');
Route::get('art/art_worklist_listing/{art_id}/{company_id}', 'ArtController@art_worklist_listing');
Route::get('art/GetScreenset_detail/{position_id}', 'ArtController@GetScreenset_detail');
Route::get('art/GetscreenColor/{screen_id}', 'ArtController@GetscreenColor');
Route::post('art/UpdateColorScreen', 'ArtController@UpdateColorScreen');
Route::get('art/getScreenSizes/{company_id}', 'ArtController@getScreenSizes');
Route::post('art/change_sortcolor', 'ArtController@change_sortcolor');
Route::post('art/change_sortscreen', 'ArtController@change_sortscreen');
Route::post('art/ArtApprovalPDF', 'ArtController@ArtApprovalPDF');
Route::post('art/PressInstructionPDF', 'ArtController@PressInstructionPDF');

// AFFILIATES ROUTERS
Route::post('affiliate/getAffiliateDetail', 'AffiliateController@getAffiliateDetail');
Route::post('affiliate/addAffiliate', 'AffiliateController@addAffiliate');
Route::post('affiliate/getAffiliateData', 'AffiliateController@getAffiliateData');
Route::post('affiliate/getAffiliateList', 'AffiliateController@getAffiliateList');
Route::post('affiliate/getAffiliateDesignProduct', 'AffiliateController@getAffiliateDesignProduct');
Route::post('affiliate/affiliateCalculation', 'AffiliateController@affiliateCalculation');

//DISTRIBUTION ROUTERS
Route::post('distribution/distributionDetail', 'DistributionController@distributionDetail');
Route::post('distribution/getDistProductAddress', 'DistributionController@getDistProductAddress');
Route::post('distribution/addEditDistribute', 'DistributionController@addEditDistribute');
Route::post('distribution/removeFromDistribute', 'DistributionController@removeFromDistribute');
Route::post('distribution/getDistSizeByProduct', 'DistributionController@getDistSizeByProduct');
Route::post('distribution/getDistAddress', 'DistributionController@getDistAddress');
Route::post('distribution/getProductByAddress', 'DistributionController@getProductByAddress');

Route::get('qbo/oauth','QuickBookController@qboOauth');
Route::get('qbo/success','QuickBookController@qboSuccess');
Route::get('qbo/disconnect','QuickBookController@qboDisconnect');
Route::get('qbo/qboConnect','QuickBookController@qboConnect');
Route::get('qbo/createCustomer','QuickBookController@createCustomer');
Route::post('qbo/AddItem', 'QuickBookController@addItem');

Route::post('invoice/listInvoice', 'InvoiceController@listInvoice');
Route::get('invoice/getInvoiceDetail/{invoice_id}/{company_id}/{type}', 'InvoiceController@getInvoiceDetail');
Route::post('invoice/createInvoicePdf', 'InvoiceController@createInvoicePdf');