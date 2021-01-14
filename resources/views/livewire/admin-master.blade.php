<div class="bg-light border-right" id="sidebar-wrapper" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="sidebar-heading">{!! Config::get('company.name') !!}</div>

    <div class="list-group list-group-flush">
        <img src="{!! asset('storage/logo.png') !!}" class="img-fluid">
        @if(kvfj(Auth::user()->permissions, 'Dashboard'))
            <button wire:click="admin" class="lk-Dashboard list-group-item list-group-item-action bg-light"><img src="{{asset('storage/svg/033-improvement.svg')}}"> @lang('Dashboard')</button>

        @endif
        @if(kvfj(Auth::user()->permissions, 'Categories'))
            <a wire:click="categories" class="lk-Categories lk-CategoryEdit list-group-item list-group-item-action bg-light"><img src="{{asset('storage/svg/038-tshirt.svg')}}"> @lang('Categories')</a>
        @endif
        @if(kvfj(Auth::user()->permissions, 'Posts'))
            <a href="{!! url('/admin/posts') !!}" class="lk-Posts lk-PostEdit lk-PostAdd lk-PostDetail list-group-item list-group-item-action bg-light"><img src="{{asset('storage/svg/001-sla.svg')}}"> @lang('Posts')</a>
        @endif
        @if(kvfj(Auth::user()->permissions, 'Pages'))
            <a href="{!! url('/admin/pages') !!}" class="lk-Pages lk-PageEdit lk-PageAdd lk-PageDetail list-group-item list-group-item-action bg-light"><img src="{{asset('storage/svg/023-data.svg')}}"> @lang('Pages')</a>
        @endif
        @if(kvfj(Auth::user()->permissions, 'Comments'))
            <a href="{!! url('admin/comments') !!}" class="lk-Comments lk-CommentEdit lk-CommentAdd lk-CommentDetail list-group-item list-group-item-action bg-light"><img src="{{asset('storage/svg/050-comments.svg')}}"> @lang('Comments')</a>
        @endif
        @if(kvfj(Auth::user()->permissions, 'Products'))
            <a href="{!! url('/admin/products') !!}" class="lk-Products lk-ProductEdit lk-ProductAdd lk-ProductDetail list-group-item list-group-item-action bg-light"><img src="{{asset('storage/svg/048-shopping bag.svg')}}"> @lang('Products')</a>
        @endif
        @if(kvfj(Auth::user()->permissions, 'Users'))
            <a href="{!! url('/admin/users/all') !!}" class="lk-Users lk-UserEdit lk-UserPermissions lk-UserProfile list-group-item list-group-item-action bg-light"><img src="{{asset('storage/svg/004-client.svg')}}"> @lang('Users')</a>
        @endif
        @if(kvfj(Auth::user()->permissions, 'Settings'))
            <a href="{!! url('/admin/settings') !!}" class="lk-Settings list-group-item list-group-item-action bg-light"><img src="{{asset('storage/svg/035-optimization.svg')}}"> @lang('Settings')</a>
        @endif
        <div class="info2 mtop16">
            {!! Auth::user()->name !!} O variables con datos empresa??
        </div>
    </div>

</div>
