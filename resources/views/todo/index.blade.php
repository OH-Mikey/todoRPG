@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/assets/css/style.css">
<link rel="stylesheet" href="/assets/css/timeline.css">
<div id="vueApp">
    <div class="outer_container">
        <div class="_container">
            <div class="timeline_item today">
                <span class="timeline_date">11/19</span>
                <div class="top_part">
                    <div class="left_part">
                        <div class="ui fluid selection dropdown">
                            <input type="hidden" name="user">
                            <i class="dropdown icon"></i>
                            <div class="default text">Chose a categary!</div>
                            <div class="menu">
                                <div class="item" data-value="item" v-for='item in choseList' v-text='item'></div>
                            </div>
                        </div>
                    </div>
                    <div class="right_part">
                        <div class="ui left icon input">
                            <input type="text" placeholder="Write some info!" v-model='today.text'
                            @keyup.enter="tagEnter">
                            <i class="users icon"></i>
                        </div>
                    </div>
                </div>
                <div class="button_part">
                    <li v-for="tag in tagList" v-text="tag.text"></li>
                </div>
            </div>
            <div class="timeline_item" v-for='timeline in timelines'>
                <span class="timeline_date">11/19</span>
                <div class="button_part">
                    <li v-for="tag in tagList" v-text="tag.text"></li>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script type="text/javascript" src="/assets/js/timeline.js"></script>
@endsection