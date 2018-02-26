@extends('layouts.master')

@section('title')
    LaraMemo | Dashboard
@endsection

@section('content')
    <header class="laramemo-header">
        <h1>LaraMemo</h1>
        <div class="avatar" style="background-image: url('{{ URL::asset("img/avatars/$user->avatar") }}');"></div>
        <div class="avatar-info">
            <div class="avatar-info-inner clearfix">
                <div class="profile-info clearfix">
                    <form action="{{ route('upload-pic') }}" method="POST" enctype="multipart/form-data" id="avatar-upload">
                        {{ csrf_field() }}
                        <div class="profile-img" style="background-image: url('{{ URL::asset("img/avatars/$user->avatar") }}');"><input type="file" id="avatar" name="avatar" class="filetype"></div>
                    </form>
                    <div class="user-info">
                        <span><b>Username</b>: {{ $user->username }}</span>
                        <span><b>Memo</b>: {{ $memo_count }}</span>
                        <span><b>Favourites</b>: {{ $like->where('is_like', 1)->count() }}</span>
                    </div>
                </div>
                <div class="github">
                    <a href="#" class="octocat">
                        <img src="{{ URL::asset('img/Octocat.png') }}" alt="Fork me on Github" />
                    </a>
                    <h3>Fork me on <a href="https://github.com/mynameismaz" class="forkme"><b>Github</b></a>!</h3>
                </div>
                <form action="{{ route('logout_user') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="submit" class="logout-link" value="Logout" />
                </form>
            </div>
        </div>
    </header>
    <div class="LaraMemo">
        <div class="LaraMemo-wrapper">
            <div class="dashboard">
                <h1>Hi, {{ ucfirst($user->username) }}!</h1>
                <div class="tabs">
                    <div class="tabs-tab tabs-recent">
                        <a href="{{ route('dashboard') }}" class="active">Most Recent</a>
                    </div>
                    <div class="tabs-tab tabs-favourites">
                        <a href="{{ route('favourites') }}">Favourites</a>
                    </div>
                </div>
                <div class="dash-cards">
                    @foreach($memos as $memo)
                        <div class="dash-card">
                            <div class="dash-card-header">
                                <h4>{{ $memo->title }}</h4>
                                <span class="date">{{ date('d/m/Y', strtotime($memo->created_at)) }}</span>
                                <hr>
                            </div>
                            <div class="dash-card-content">
                                <p>{{ $memo->content }}</p>
                            </div>
                            <div class="dash-card-footer">
                                <a href="#"><span class="fa fa-heart icon-heart-empty {{ $like->where('memo_id', $memo->id)->first() ? $like->where('memo_id', $memo->id)->first()->is_like == 1 ? ' liked' : '' : '' }}" data-id="{{ $memo->id }}"></span></a>
                                <form action="{{ route('memo.destroy', ['memoID' => $memo->id]) }}" method="POST" class="memodelete">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <span class="fa fa-trash"></span>
                                </form>
                                <a href="{{ route('memo.edit', [ 'memo_ID' => $memo->id ]) }}"><span class="fa fa-pencil"></span></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div><!-- /.LaraMemo-wrapper -->

        <div class="create-LaraMemo">
            <a href="{{ route('create-page') }}"><span class="fa fa-plus add-memo"></span></a>
        </div>
    </div><!-- /.LaraMemo -->
    
    <!-- Javascript -->
    <script>
        var url = '{{ route('like') }}';
        var _token = '{{ Session::token() }}';
    </script>
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('js/script.js') }}"></script>
@endsection