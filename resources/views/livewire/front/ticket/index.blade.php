<div>
    <livewire:front.layout.menu :lang="$multiLanguage">
    <livewire:front.page.layout.title :title="__('Tickets')" />
  

    <div class="py-12 p-3" >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                  <div class="col-lg-12">
                <div class="card custom-card " style="padding: 20px">
                    
                    <div class="card-body">

                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive scrollbar" id="style-1" >
                                        <table class="table dataTable no-footer dtr-inline " id="example2"
                                               role="grid" aria-describedby="example2_info">
                                            <thead >
                                                <tr>
                                                  
                                                    <th class="wd-lg-20p">
                                                        <span>title</span>
                                                        
                                                    </th>
                                                    <th scope="col">status</th>
                                                    <th scope="col">latest update</th>
                                                    <th scope="col">operation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($tickets as $ticket)
                                                <tr>
                                                    
                                                    <td>{{ $ticket->created_at }}</td>
                                                    <td>{{$ticket->part}}</td>
                                                    <td>{{$ticket->title}}</td>
                                                    <td>{{$this->status($ticket->id)}}</td>
                                                    <td>{{ $ticket->updates_at}}</td>
                                                    <td>
                                                        <a href="{{$multiLanguage ? route('front.ticket.edit.language',['language'=>app()->getLocale(),'id'=>$ticket->id]) : route('front.ticket.edit',$ticket->id)}}"  class="btn btn-sm btn-info">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        
                                                       
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                              
                                    {{$tickets->links()}}
                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
        <livewire:front.layout.footer :language="$multiLanguage">

</div>