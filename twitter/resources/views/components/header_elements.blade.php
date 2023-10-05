@if(empty($headerInvisibleElements['mypage']) || !$headerInvisibleElements['mypage'])
<li class="nav-item">    
    <a class="nav-link" href="{{ route('mypage') }}">{{ __('Mypage') }}</a>
</li>
@endif

@if(empty($headerInvisibleElements['mypageEdit']) || !$headerInvisibleElements['mypageEdit'])
<li class="nav-item">    
    <a class="nav-link" href="{{ route('mypage.edit') }}">{{ __('Edit') }}</a>
</li>
@endif

@if(empty($headerInvisibleElements['userlist']) || !$headerInvisibleElements['userlist'])
<li class="nav-item">    
    <a class="nav-link" href="{{ route('users') }}">{{ __('Userlist') }}</a>
</li>
@endif

@if(empty($headerInvisibleElements['tweet']) || !$headerInvisibleElements['tweet'])
<li class="nav-item">    
    <a class="nav-link" href="{{ route('tweet') }}">{{ __('Tweet') }}</a>
</li>
@endif

@if(empty($headerInvisibleElements['tweetlist']) || !$headerInvisibleElements['tweetlist'])
<li class="nav-item">    
    <a class="nav-link" href="{{ route('tweet.list') }}">{{ __('Tweetlist') }}</a>
</li>
@endif

@if(empty($headerInvisibleElements['followlist']) || !$headerInvisibleElements['followlist'])
<li class="nav-item">    
    <a class="nav-link" href="{{ route('follow.followlist') }}">{{ __('Followlist') }}</a>
</li>
@endif

@if(empty($headerInvisibleElements['followerlist']) || !$headerInvisibleElements['followerlist'])
<li class="nav-item">    
    <a class="nav-link" href="{{ route('follow.followerlist') }}">{{ __('Followerlist') }}</a>
</li>
@endif

@if(empty($headerInvisibleElements['tweetsearch']) || !$headerInvisibleElements['tweetsearch'])
<li class="nav-item">    
    <a class="nav-link" href="{{ route('tweet.searchclear') }}">{{ __('TweetSearch') }}</a>
</li>
@endif

@if(empty($headerInvisibleElements['likelist']) || !$headerInvisibleElements['likelist'])
<li class="nav-item">    
    <a class="nav-link" href="{{ route('likelist') }}">{{ __('Likelist') }}</a>
</li>
@endif
