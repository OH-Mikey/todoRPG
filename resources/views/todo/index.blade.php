@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/timeline.css">

    <div id="app">
        <div class="outer_container">
            <div class="_container">
                <div class="timeline_item" v-for='timeline in timelines'>
                    <span class="timeline_date">11/19</span>
                    <div class="top_part">
                        <div class="left_part">
                            <div class="ui left icon input">
                                <input type="text" placeholder="Search users...">
                                <i class="users icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="button_part">
                        <div class="right_part">hello</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script type="text/javascript" src="/assets/js/timeline.js"></script>
@endsection
