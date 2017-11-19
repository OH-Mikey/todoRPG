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
                            <div class="default text">Select Friend</div>
                            <div class="menu">
                                <div class="item" data-value="jenny">
                                    Jenny Hess
                                </div>
                                <div class="item" data-value="elliot">
                                    Elliot Fu
                                </div>
                                <div class="item" data-value="stevie">
                                    Stevie Feliciano
                                </div>
                                <div class="item" data-value="christian">
                                    Christian
                                </div>
                                <div class="item" data-value="matt">
                                    Matt
                                </div>
                                <div class="item" data-value="justen">
                                    Justen Kitsune
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="right_part">
                        <div class="ui left icon input">
                            <input type="text" placeholder="Search users..." v-model='today.tag'
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