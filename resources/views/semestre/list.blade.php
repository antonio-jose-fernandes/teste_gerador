@extends('layout')
@section('head')
  <div class="panel-header panel-header-sm"></div>
@endsection
@section('topo')
  <a class="navbar-brand" href="{{route('semestre.new')}}"><h3>Novo semestre</h3></a>
@endsection
@section('pesquisa')
  <form action="{{route('semestre.search')}}" method="get" id="pesquisar">
     @csrf
     <div class="input-group no-border">
       <input type="text" class="form-control" placeholder="Pesquisar..." name="filtro" id="filtro"
         @if(isset($filtro)) 
            value="{{$filtro}}"
         @endif  >
      <div class="input-group-append">
          <div class="input-group-text" onclick="document.getElementById('pesquisar').submit();">
           <i  class="now-ui-icons ui-1_zoom-bold"></i>
      </div>
    </div>
   </div>
@endsection
@section('conteudo')
<a class="btn"  href="{{route('semestre.new')}}">Nova semestre</a>
  <div class="row">

     <div class="col-md-12">
         <div class="card">
            <div class="card-header">
                  <h4 class="card-title">Semestres </h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
<table class="table"> 
  <thead>
     <th> Descrição </th>
     <th  class="text-left" style="width: 180px;">    </th>
  </thead>
  <tbody>
  @if(sizeof($lista)>0)
    @foreach($lista as $ent)
      <tr>
          <td>{{$ent->descricao}}</td> 
        <td  class="text-left" style="width: 180px;"> 
        <a rel="tooltip" title="Editar"
            class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral"
            data-original-title="Edit"
            href="{{route('semestre.edit',$ent->id)}}">
            <ion-icon name="create-outline"></ion-icon>
         </a>
         <a href="{{route('semestre.delete',$ent->id)}}"
            onclick="return confirm('Deseja relamente excluir?')"
            rel="tooltip"
            title="Excluir"
            class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral"
            data-original-title="Remove">
            <ion-icon name="trash-outline"></ion-icon>
         </a>
        </td> 
  @endforeach 
  @endif 
   </tbody> 
 </table> 
 <div>
                  @if ($lista->lastPage() > 1)
                     @php
                     $paginator=$lista;
                     $paginator->url = route('semestre.list');
                  @endphp
                  <ul class="pagination">
                     <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
                          <a href="{{$paginator->url."?page=1&filtro=".$filtro }}">&nbsp;<<&nbsp;&nbsp;</a>
                     </li>
                  @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                  <?php
                      $link_limit = 7;
                      $half_total_links = floor($link_limit / 2);
                      $from = $paginator->currentPage() - $half_total_links;
                      $to = $paginator->currentPage() + $half_total_links;
                      if ($paginator->currentPage() < $half_total_links) {
                         $to += $half_total_links - $paginator->currentPage();
                      }
                      if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                          $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
                      }    ?>
                     @if ($from < $i && $i < $to)
                       <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                        @if($paginator->currentPage() == $i)
<a href="{{ $paginator->url."?page=".$i."&filtro=".$filtro }} "> <b>{{ $i }}</b> &nbsp; </a>
 @else
<a href="{{ $paginator->url."?page=".$i."&filtro=".$filtro }} ">{{ $i }} &nbsp; </a>
 @endif
                      </li>
                     @endif
                  @endfor
                  <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                      <a href="{{ $paginator->url."?page=".$paginator->lastPage()."&filtro=".$filtro }}"> >></a>
                  </li>
                 </ul>
              @endif
           </div>           </div>
            </div>
        </div>
     </div>
   </div>
@endsection
