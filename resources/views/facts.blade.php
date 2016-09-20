@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Fact
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    <form action="{{ url('fact')}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-fact" class="col-sm-3 control-label">Fact</label>
                            <div class="col-sm-6">
                                <textarea name="content" id="task-fact" class="form-control" value="{{ old('fact') }}"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="task-tag" class="col-sm-3 control-label">Tag</label>
                            <div class="col-sm-6">
                                <input name="tag" id="task-tag" class="form-control" value="{{ old('tag') }}"></input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="task-source" class="col-sm-3 control-label">Source</label>
                            <div class="col-sm-6">
                                <input name="source" id="task-source" class="form-control" value="{{ old('source') }}"></input>
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Fact
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($facts) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Facts
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Fact</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($facts as $fact)
                                    <tr>
                                        <td class="table-text"><div>{!! nl2br( preg_replace('/&lt;(em|strong|b|i)&gt;(.*)&lt;\/(em|strong|b|i)&gt;/', '<$1>$2</$1>', e($fact->content) ) ) !!}</div></td>


                                        <!-- Task Delete Button -->
                                        <td>
                                            <form action="{{ url('fact/'.$fact->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection