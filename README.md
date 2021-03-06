# Laravel Table Manager 

#### Installation
[installation guide] (https://github.com/munkh-altai/table-manager#installation-guide)

#### Examples
[Sample example] (https://github.com/munkh-altai/table-manager#sample-example-Хэлний-хүснэгтийг-удирдах-жишээ),
[Sample example with translation] (https://github.com/munkh-altai/table-manager#sample-example-with-transltation-Орчуулгийн-хүснэгтийг-удирдах-жишээ)



#### Main Features

- [Configration] (https://github.com/munkh-altai/table-manager#configration)
- [Translation & Static Words] (https://github.com/munkh-altai/table-manager#translation--static-words)

#### Grid Features

- Dynamic grid
- Fixed Rom & Column in grid
- Auto calculation like excel
- Responsive
- Grid permission CRUD
- Grid column types image, link, internal link ...
- [Change enum column's value in grid row] (https://github.com/munkh-altai/table-manager#change-enum-columns-value-in-grid-row)
- Inline add & edit
- translation
- [CRUD permission] (https://github.com/munkh-altai/table-manager#crud-permission)
- Order
- Page name
- Created at
- Updated at
- where condition
- export CSV file (excel)
- reload module
- Change language
- visbile & hide grid column's
- resize column & row
- Sort
- Search
- Filter column
- Inline form validation
- Pagination
- Change per page items
- Count total items
- Count total pages
- [Before delete] (https://github.com/munkh-altai/table-manager#before-delete)


#### Form Features

- Dynamic form
- [Show and Hide by other element's value] (https://github.com/munkh-altai/table-manager#show-and-hide-by-other-elements-value)
- [Before insert] (https://github.com/munkh-altai/table-manager#before-insert)
- [Support multi element types] (https://github.com/munkh-altai/table-manager#support-multi-element-types)
- Translation
- validation (required, max, min, number, email, unique, password confirm)
- After save message
- Custom After save message
- group element
- Disable element from grid permission
- Sub items support
- Multi insert once time
- Focus index
- if update disabled can edit columns by other element value
- password change mode

#### Installation guide
1. install
```php
composer require munkh-altai/table-manager
 ```
2. In the $providers array add the service providers for this package in config/app.php.

```php
TableManager\TableManagerServiceProvider::class,
```

3. Add the facade of this package to the $aliases array  in config/app.php.
 ```php
 'TableManager' => TableManager\Facade\TableManager::class,
 ```
4. composer du

5. publish config
```
php artisan vendor:publish --tag=tm-config
```
6. set your route
```php


    Route::get('/{slug}/', 'AdminController@TableManager');
    Route::post('/{slug}/{action}', 'AdminController@TableManager');


```
7. add module name in use section your controller
```php
use TableManager\TableManager;
```
8. create your view with css and javascript of table properties

css
```html
@if(Config::get('table-manager.debug'))
        <link rel="stylesheet" href="http://localhost:3000/css/tm.css" type="text/css"/>
    @else
        <link rel="stylesheet" href="{{ URL::asset('shared/table-manager/css/tm.css') }}" type="text/css"/>
    @endif
```
app div
```html
<div id="solar-tp"></div>
<script>
   window.setup = {!! json_encode($setup) !!};
</script>
@if($setup['googleMap'] == true)
   <script src="https://maps.googleapis.com/maps/api/js"></script>
@endif
```
javascript
```html
 <script type="text/javascript" charset="utf-8" src="{{ URL::asset('shared/ckeditor/ckeditor.js')}}"></script>
    @if(Config::get('tp_config.tp_debug'))
        <script src="http://localhost:3000/js/dependencies.js"></script>
        <script src="http://localhost:3000/js/tm.js"></script>
    @else
        <script type="text/javascript" charset="utf-8"
                src="{{ URL::asset('shared/table-manager/js/dependencies.js')}}"></script>
        <script type="text/javascript" charset="utf-8"
                src="{{ URL::asset('shared/table-manager/js/tm.js')}}"></script>
    @endif
```

9. Last add once funtion to your controller
```php
 public function TableProperties($slug, $action = 'index') {

        if (!method_exists($this, $slug))
        abort(503);
         else
            return $this->$slug($action);

    }

```

10. Crate CRUD funciton
```php
public function users($action)
    {

        $tm = new TableManager();

        $tm->viewName = 'table-manager';
        $tm->table = 'users';
        $tm->page_name = 'Хэрэглэгч';
        $tm->identity_name = 'id';
        $tm->grid_columns = [
            'users.name',
            'users.email',
            'users.id'];
        $tm->grid_default_order_by = 'users.id DESC';
        $tm->formType = 'page';
        $tm->created_at = 'created_at';
        $tm->updated_at = 'updated_at';
        $tm->where_condition = [];


        $tm->grid_output_control = [

            ['column' => 'name', 'title' => 'Нэр', 'type' => '--text', 'fixed' => false],
            ['column' => 'email', 'title' => 'И-мэйл', 'type' => '--text', 'fixed' => false],

        ];

        $tm->form_input_control = [

            ['column' => 'name', 'title' => 'Нэр', 'type' => '--text', 'value' => null, 'validate' => 'required'],

            ['column' => 'email', 'title' => 'И-мэйл', 'type' => '--text', 'value' => null, 'validate' => 'required|email|unique:users,email,NULL,' . $tm->identity_name],
        ];



        return $tm->run($action);


    }
```

#### Configration

Module-г publish хийсэний дараа laravel framework-н "config" folder дотор "tp_config.php" гэсэн тохиргооны file хуулагдана.

Configration list, Тохиргооны жагсаалт
- form & grid buttons's text
- debug mode controll
- default locale
- locale's table
- static word's table



#### Translation & Static Words

Орчуулгийн боломжийг grid болон form дээр ашиглахын тулд хэлний хүснэгт өгөгдлийн сант үүссэн байх шаардлагатай

solar_locales table's columns (id, code, language, flag)

Мөн хэрэглэгч талд зориулан i18 стандартын JSON болон laravel-д зориулсан орчуулгийн file үүсгэх боломж байгаа. solar_static_words table's columns (id, key, translation)

[Орчуулгийн хүснэгтийг удирдах жишээ] (https://github.com/munkh-altai/table-manager#sample-example-with-transltation-Орчуулгийн-хүснэгтийг-удирдах-жишээ)


# Grid Features

#### Change enum column's value in grid row

Grid дээр харуулах мөр доторх баганыг утгаас нь хамаарч өөр текст харуулах бол хэргэлнэ.
Жишээ:

```php
$tp->form_input_control = [
['column'=>'is_buleg', 'title'=>'Бүлэг эсэх', 'type'=>'--text', 'change_value'=>[
                ['value'=>0, 'text'=>'Үгүй'],
                ['value'=>1, 'text'=>'Тийм'],
            ]
    ],
];
```

#### CRUD permission
module-д эрх зааж өгж болно.
Default
```php
$tp->permission = ['c'=>true, 'r'=>true, 'u'=>true, 'd'=>true];
```
#### Before delete

grid-н мөр устгахаас өмнө ажиллах үйлдэл.
Жишээ:

```php

 $tp->before_delete = [
            'controller'=>'App\Http\Controllers\AdminController',
            'function'=>'beforeDeleteAanSalbar'
        ];


 //exmample before delete function
   public function beforeDeleteAanSalbar($id){
        $userid = DB::table('aan')->select('user_id')->where('ID', '=', $id)->pluck('user_id');

        DB::table('users')->where('id', '=', $userid)->delete();

    }
```

# Form Features

#### Show and Hide by other element's value

Өөр элелентийн утгаас хамаарч харуулах, нуух. Энэ боломж нь аль нэг элементийн утгаас хамаарч тухайн элеметийг харуулах, нуух үйлдэл хийнэ.  Form-н column нь дотроо хийж өгөнө 'show'=>[['is_baiguullaga'=>0]]  хийж өгөхдөө ямар элеметийн утга ямар байхад харуулах аа бичиж өгнө.
Жишээ:

```php
$tp->form_input_control = [
 ['column'=>'is_baiguullaga', 'title'=>'Ажил олгогчийн төрөл', 'type'=>'--radio', 'value'=>0, 'choices'=>[
                ['value'=>0, 'text'=>'Аж ахуйн нэгж, байгууллага'],
                ['value'=>1, 'text'=>'Иргэн'],
 ], 'validate'=>'required'],
 ['column'=>'omch_huvi', 'title'=>'Өмчийн хувь', 'type'=>'--number', 'value'=>null, 'validate'=>'required' , 'show'=>[['is_baiguullaga'=>0]]],
];
```


#### Before insert

Form-н мэдээллийг хадгалахаас өмнө мэдээллийг өөрчлөх эсвэл мэдээлэл нэмэх боломжтой, ямар нэгэн Conroller-н Function зааж өгнө.
Жишээ:

```php

$tp->before_insert = [
            'controller'=>'App\Http\Controllers\AdminController',
            'function'=>'beforeInsertUser',
            'arguments'=>[]
 ];


 //exmample before insert function
    public function beforeInsertUser($data){
         $insert_values = $data['insert_values'];

         $user = [];

         $pass = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);

         $toMail = $insert_values['email'];

         Mail::send('mail.register', ['password'=>$pass, 'email'=>$toMail], function($message) use ($toMail) {
             $message->to($toMail);
             $message->subject('Нэвтрэх нууц үг');
         });

         return ['password'=>bcrypt($pass)];
     }
```

#### Support multi element types

- --text
- --number
- --money
- --email
- --link
- --textarea
- --disabled
- --ckeditor
- --drag-map (select location on google map by drag arrow)
- --single-file
- --multi-file
- --date
- --datetime
- --time
- --combogrid
- --combobox
- --combobox-addable
- --tag
- --checkbox
- --radio
- --password
- --password-confirm
- --auto-calculate (sum, multfly, minus)

#### Sample example, Хэлний хүснэгтийг удирдах жишээ

```php
    public function locales ($action){

        $tp = new Tp();
        $tp->viewName = 'admin._pages.options';
        $tp->table = 'solar_locales';
        $tp->page_name = 'Хэл';
        $tp->identity_name = 'id';
        $tp->grid_default_order_by = 'id DESC';
        $tp->grid_columns = ['code', 'language', 'flag', 'id'];

        $tp->grid_output_control = [
            ['column'=>'code', 'title'=>'Улсын код', 'type'=>'--text'],
            ['column'=>'language', 'title'=>'Хэл', 'type'=>'--text'],
            ['column'=>'flag', 'title'=>'Туг', 'type'=>'--text'],
        ];
        $tp->form_input_control = [

            ['column'=>'code', 'title'=>'Улсын код', 'type'=>'--text', 'value'=>null, 'validate'=>'required'],
            ['column'=>'language', 'title'=>'Хэл', 'type'=>'--text', 'value'=>null, 'validate'=>'required'],
            ['column'=>'flag', 'title'=>'Туг', 'type'=>'--text', 'value'=>null, 'validate'=>'required'],

        ];
        $tp->formType = 'page';
        return $tp->run($action);


    }
```

#### Sample example with transltation, Орчуулгийн хүснэгтийг удирдах жишээ

```php
   function staticWords($action){
        $tp = new Tp();
        $tp->viewName = 'admin._pages.options';;
        $tp->table = 'solar_static_words';
        $tp->page_name = 'Статик үгсийн сан';
        $tp->identity_name = 'id';
        $tp->grid_default_order_by = 'id DESC';
        $tp->grid_columns = ['key', 'translation', 'id'];
        $tp->generateLocaleFile = true;

        $tp->grid_output_control = [
            ['column' => 'key', 'title' => 'Түлхүүр үг', 'type' => '--text'],
            ['column' => 'translation', 'title' => 'Орчуулга', 'type' => '--text', 'translate' =>true],
        ];
        $tp->form_input_control = [
            ['column' => 'key', 'title' => 'Түлхүүр үг', 'type' => '--text', 'value' => null, 'validate' => 'required'],
        ];

        $tp->translate_form_input_control = [
            ['column' => 'translation', 'title' => 'Орчуулга', 'type' => '--text', 'value' => null, 'validate' => 'required'],
        ];

        $tp->formType = 'page';
        return $tp->run($action);

    }

```
