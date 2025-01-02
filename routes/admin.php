<?php

use App\Livewire\Admin\User\UserList;
use App\Livewire\Admin\User\UserCrud;
use App\Livewire\Admin\Setting\CountryList;
use App\Livewire\Admin\Setting\CountryCrud;
use App\Livewire\Admin\Setting\CityList;
use App\Livewire\Admin\Setting\CityCrud;
use App\Livewire\Admin\Setting\LocationCrud;
use App\Livewire\Admin\Setting\CurrencyCrud;
use App\Livewire\Admin\Setting\LanguageCrud;
use App\Livewire\Admin\Setting\SettingsCrud;
use App\Livewire\Admin\Page\PageList;
use App\Livewire\Admin\Page\PageCrud;
use App\Livewire\Admin\Module\Modules;
use App\Livewire\Admin\Menu\MenuCrud;
use App\Livewire\Admin\Hotel\HotelAmenityCrud;
use App\Livewire\Admin\Hotel\HotelAmenityList;
use App\Livewire\Admin\Hotel\HotelList;
use App\Livewire\Admin\Hotel\HotelCrud;
use App\Livewire\Admin\Car\CarCategoryList;
use App\Livewire\Admin\Car\CarCategoryCrud;
use App\Livewire\Admin\Car\CarMakeList;
use App\Livewire\Admin\Car\CarMakeCrud;
use App\Livewire\Admin\Car\CarModelList;
use App\Livewire\Admin\Car\CarModelCrud;
use App\Livewire\Admin\Car\CarList;
use App\Livewire\Admin\Car\CarCrud;
use App\Livewire\Admin\Blog\BlogCategoryList;
use App\Livewire\Admin\Blog\BlogCategoryCrud;
use App\Livewire\Admin\Blog\BlogList;
use App\Livewire\Admin\Blog\BlogCrud;

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', UserList::class)->name('admin.dashboard');
    Route::get('/user', UserList::class)->name('admin.user');
    Route::get('/user/create', UserCrud::class)->name('admin.user.create');
    Route::get('/user/edit/{id}', UserCrud::class)->name('admin.user.edit');

    Route::get('/countries', CountryList::class)->name('admin.countries');
    Route::get('/countries/create', CountryCrud::class)->name('admin.countries.create');
    Route::get('/countries/edit/{id}', CountryCrud::class)->name('admin.countries.edit');
    Route::get('/cities', CityList::class)->name('admin.cities');
    Route::get('/cities/create', CityCrud::class)->name('admin.cities.create');
    Route::get('/cities/edit/{id}', CityCrud::class)->name('admin.cities.edit');
    Route::get('/locations', LocationCrud::class)->name('admin.locations');   
    Route::get('/currencies', CurrencyCrud::class)->name('admin.currencies');
    Route::get('/languages', LanguageCrud::class)->name('admin.languages');
    Route::get('/settings', SettingsCrud::class)->name('admin.settings');
    
    Route::get('/page', PageList::class)->name('admin.page');
    Route::get('/page/create', PageCrud::class)->name('admin.page.create');
    Route::get('/page/edit/{id}', PageCrud::class)->name('admin.page.edit');
    
    Route::get('/admin/modules', Modules::class)->name('admin.modules');

    Route::get('/menu', MenuCrud::class)->name('admin.menu');

    Route::get('/hotel/amenity/create', HotelAmenityCrud::class)->name('admin.hotel.amenity.create');
    Route::get('/hotel/amenity/edit/{id}', HotelAmenityCrud::class)->name('admin.hotel.amenity.edit');
    Route::get('/hotel/amenities', HotelAmenityList::class)->name('admin.hotel.amenity');
    Route::get('/hotels', HotelList::class)->name('admin.hotel');
    Route::get('/hotel/create', HotelCrud::class)->name('admin.hotel.create');
    Route::get('/hotel/edit/{id}', HotelCrud::class)->name('admin.hotel.edit'); 
    
    // car category
    Route::get('/car-category', CarCategoryList::class)->name('admin.car.category');
    Route::get('/car-category/create', CarCategoryCrud::class)->name('admin.car.category.create');
    Route::get('/car-category/edit/{id}', CarCategoryCrud::class)->name('admin.car.category.edit');

    // car make
    Route::get('/car-make', CarMakeList::class)->name('admin.car.make');
    Route::get('/car-make/create', CarMakeCrud::class)->name('admin.car.make.create');
    Route::get('/car-make/edit/{id}', CarMakeCrud::class)->name('admin.car.make.edit');   
    
    // car model
    Route::get('/car-model', CarModelList::class)->name('admin.car.model');
    Route::get('/car-model/create', CarModelCrud::class)->name('admin.car.model.create');
    Route::get('/car-model/edit/{id}', CarModelCrud::class)->name('admin.car.model.edit');   

    // car
    Route::get('/car', CarList::class)->name('admin.car');
    Route::get('/car/create', CarCrud::class)->name('admin.car.create');
    Route::get('/car/edit/{id}', CarCrud::class)->name('admin.car.edit');  
    
    Route::get('/blog/categories', BlogCategoryList::class)->name('admin.blog.category');
    Route::get('/blog/categories/create', BlogCategoryCrud::class)->name('admin.blog.category.create');
    Route::get('/blog/categories/edit/{id}', BlogCategoryCrud::class)->name('admin.blog.category.edit');
    Route::get('/blog', BlogList::class)->name('admin.blog');    
    Route::get('/blog/create', BlogCrud::class)->name('admin.blog.create');    
    Route::get('/blog/edit/{id}', BlogCrud::class)->name('admin.blog.edit');    
    
});
