@extends('layouts.dt')
@section('title', 'Db Backup')
@section('widget-title', 'Database Backups')
@section('widget-desc', 'Manage Backups')
@section('dt-title', 'Database')
@section('actions')
    <a href="" data-toggle="modal" data-target="#remoteModal" class="btn btn-success btn-lg pull-right header-btn hidden-mobile">
        <i class="fa fa-circle-arrow-up fa-lg"></i>
        Add Stream
    </a>
@endsection
@section('content')
 <div class="row-fluid">

     <div class="col-lg-offset-3">
         <br>
         <a class="btn btn-success btn-block" href="{{ url('make-backup') }}">Create database backup</a>
         kjlaesjfioojvgfejvjjsjviosajojjioajkj

     </div>
 </div>
@endsection

@section('modal')
    {{--many modal as possible--}}
    <!-- MODAL PLACE HOLDER -->
    {{--modal for add--}}
    <div class="modal fade" id="remoteModal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">Add contact types </h4>
                </div>
                <div class="modal-body no-padding">

                    <fieldset>
                        <section>
                            <div class="row">

                            </div>
                        </section>


                    </fieldset>

                    <footer>
                    </footer>



                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL -->
@endsection