@extends('layouts.app')

@section('content')
    <router-view></router-view>
    <router-view name="genre-router-view" :type="'page'" :mode="'genre'" :key="$route.params.query"></router-view>
    <router-view name="search-router-view" :type="'page'" :mode="'search'" :key="$route.params.query"></router-view>
    <router-view name="page-router-view"></router-view>
@endsection
