

@component('admin.layouts.content',['title'=>'پنل مدیریت'])



@slot('breadcrumb')
<li class="breadcrumb-item active">پنل مدیریت</li>
<li class="breadcrumb-item"><a href="/admin/users">لیست کاربران</a></li>
<li class="breadcrumb-item active"><a href="/admin/products">لیست محصولات</a></li> 
<li class="breadcrumb-item active"><a href="/admin/discountplans">لیست طرح ها و جشنواره ها</a></li>







@endslot









<h2>Admin Panel</h2>










@endcomponent