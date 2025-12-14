@extends('layouts.app')
@section('content')
    <div class="card">
            <h2 class="section-title">Music Recap</h2>
            <div class="top-songs">
                <div class="left">
                    <h3 style="margin:0 0 12px">Top Songs</h3>
                    <div class="song-row">
                        <div class="song-meta">XXL - LANY</div>
                        <div class="bar-wrap"><div class="bar" style="width:70%"></div><span>80 plays</span></div>
                    </div>
                    <div class="song-row">
                        <div class="song-meta">The Nights - Avicci</div>
                        <div class="bar-wrap"><div class="bar" style="width:55%"></div><span>50 plays</span></div>
                    </div>
                    <div class="song-row">
                        <div class="song-meta">Lover - Taylor Swift</div>
                        <div class="bar-wrap"><div class="bar" style="width:40%"></div><span>35 plays</span></div>
                    </div>
                    <div class="song-row">
                        <div class="song-meta">Nothing - Bruno Major</div>
                        <div class="bar-wrap"><div class="bar" style="width:30%"></div><span>25 plays</span></div>
                    </div>
                    <div class="song-row">
                        <div class="song-meta">Ivy - Frank Ocean</div>
                        <div class="bar-wrap"><div class="bar" style="width:18%"></div><span>10 plays</span></div>
                    </div>
                </div>
            </div>

            <h3 style="margin-top:28px">Your Playlist</h3>
            <div class="playlists">
                <div class="pl-btn">+ Playlist</div>
                <div class="pl-btn">+ Playlist</div>
                <div class="pl-btn">+ Playlist</div>
                <div class="pl-btn">+ Playlist</div>
                <div class="pl-btn">+ Playlist</div>
                <div class="pl-btn">+ Playlist</div>
            </div>

            <h3 style="margin-top:28px">Recently Played</h3>
            <div class="recent">
                <div class="tile">TOP 50</div>
                <div class="tile">TOP 50</div>
                <div class="tile">TOP 50</div>
                <div class="tile">TOP 50</div>
            </div>
        </div>
@endsection


