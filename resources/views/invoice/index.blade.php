@extends('layouts.app')
@section('styleTags')
  <style media="screen">
    div.container{
      margin-top: 2%;
    }
    .hide{
      display: none;
    }
    .active {
      display: unset !important;
    }
    td,th {
      text-align: center;
    }
    [v-cloak] {
      display:none;
    }
  </style>
@endsection
@section('content')

  <div class="container" id="vue-invoice">
    <div class="row">
      <div class="col-md-12">
        <div class="alert hide center"  v-bind:class="{ active: isActive, 'alert-danger': hasError, 'alert-success': noError}">
          @{{message}}
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <span class="pull-right">
          <a href="{{route('invoice.create')}}" class="btn btn-primary">New Invoice</a>
        </span>
      </div>
    </div>
    <table class="table table-responsive table-striped">
      <thead>
        <th>Sr #</th>
        <th>Invoice Number</th>
        <th>Invoice Title</th>
        <th>Invoice Order-Number</th>
        <th>Invoice status</th>
        <th>Action</th>
      </thead>
      <tbody>
        <tr v-for="(invoice,sr) in invoices">
          <td v-cloak>@{{ sr+1 }}</td>
          <td v-cloak>@{{ invoice.invoice_num }}</td>
          <td v-cloak>@{{ invoice.title }}</td>
          <td v-cloak>@{{ invoice.invoice_detail.order_num }}</td>
          <td v-cloak>@{{ invoice.status }}</td>
          <td v-cloak>
            <span> <a :href="`invoice/${invoice.id}/edit`">
              <i class="fas fa-edit"> </i> </span> ,
            </a>
            <span >
              <a  v-on:click="deleteInvoice(invoice.id)">
                <i class="fas fa-trash-alt"></i>
              </a>
              </span>
            </td>
        </tr>
      </tbody>
    </table>
    <div class="row">
      <ul class="pagination pull-right" v-cloak>
          <li class="page-item"  :class="[{disabled: !pagination.prev_page_url}]">
          <a class="page-link" href="#"  @click="getInvoices(pagination.prev_page_url)"
          >Previous</a></li>

          <li class="page-item disabled"><a class="page-link text-dark" href="#">
          Page @{{pagination.current_page}} of @{{pagination.last_page}}
          </a></li>

          <li class="page-item" :class="[{disabled: !pagination.next_page_url}]"><a class="page-link"
          @click="getInvoices(pagination.next_page_url)" href="#">Next</a></li>
        </ul>
    </div>
  </div>
@endsection
@section('scriptTags')
  <script src="{{asset('js/app.js')}}"></script>

<script type="text/javascript">
const app = new Vue({
el: '#vue-invoice',
data: {
  invoices: {},
  pagination: {},
  isActive: false,
  hasError: false,
  noError: false,
  message:''
},
created(){
  this.getInvoices();
},
methods: {
  getInvoices(page_url){
    let self =this;
    page_url=page_url || 'getInvioces'
    axios.get(page_url)
      .then((response) => {
        self.invoices=response.data.data;
        self.makePagination(response.data);

      })
      .catch(function (error) {
        console.log(error);
    });
  },
  edit: function(id) {
    alert(`invoice/${id}/edit`);
    url = `/invoice/${id}/edit`;
      location = url;
  },
  deleteInvoice: function(id) {
    if(confirm('Do you want to Delete it?')){
      axios.delete('invoice/'+id)
            .then((response) => {
              this.message=response.data.message;
              this.isActive=true;
              this.noError=true;
              this.getInvoices();
              var self=this;

              setTimeout(function(){
                  self.isActive = false;
              }, 2000);

            })
            .catch(function (error) {
              this.message=response.data.message;
              this.isActive=true;
              this.hasError=true;

              setTimeout(function(){
                  self.isActive = false;
              }, 2000);

            });
        }
    },
    makePagination(meta) {
        let pagination = {
          current_page: meta.current_page,
          last_page: meta.last_page,
          next_page_url: meta.next_page_url,
          prev_page_url: meta.prev_page_url
        }
        this.pagination=pagination;
      }
  }
});
</script>

@endsection
