@extends('layouts.master')

@section('title')
    LaraMemo | Dashboard
@endsection

@section('content')
    <header class="laramemo-header">
        <h1>LaraMemo</h1>
        <div class="avatar"></div>
        <div class="avatar-info">
            <div class="avatar-info-inner clearfix">
                <div class="profile-info clearfix">
                    <div class="profile-img"></div>
                    <div class="user-info">
                        <span><b>Username</b>: Alex</span>
                        <span><b>Memo</b>: 30</span>
                        <span><b>Favourites</b>: 21</span>
                    </div>
                </div>
                <div class="github">
                    <a href="#" class="octocat">
                        <img src="{{ URL::asset('img/Octocat.png') }}" alt="Fork me on Github" />
                    </a>
                    <h3>Fork me on <a href="https://github.com/mynameismaz" class="forkme"><b>Github</b></a>!</h3>
                </div>
                <a class="logout-link" href="#">Logout</a>
            </div>
        </div>
    </header>
    <div class="LaraMemo">
        <div class="LaraMemo-wrapper createMemo-wrapper">
            @include('includes.errors')
            <form action="{{ route('memo.update', ['memo_ID' => $memo->id ]) }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title" class="sr-only">Title</label>
                    <input type="text" name="title" placeholder="Title" value="{{ $memo->title }}" />
                </div>
                <div class="form-group">
                    <label for="content" class="sr-only">Content for your Memo</label>
                    <textarea name="content" placeholder="Content">{{ $memo->content }}</textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="submit-btn" value="Submit" />
                </div>

                <input type="hidden" name="_method" value="PUT" />
            </form>
        </div><!-- /.LaraMemo-wrapper -->

        <div class="create-LaraMemo">
            <a href="{{ route('dashboard') }}"><span class="fa fa-times add-memo"></span></a>
        </div>
    </div><!-- /.LaraMemo-wrapper -->
        
@endsection