
<style>
    .alert {
      padding: 20px;
      background-color: #f44336;
      color: white;
      font-size: 15px;
    }
    
    .closebtn {
      margin-left: 15px;
      color: white;
      font-weight: bold;
      float: right;
      font-size: 22px;
      line-height: 20px;
      cursor: pointer;
      transition: 0.3s;
    }
    
    .closebtn:hover {
      color: black;
    }
    </style>
    @if(Session::has('error'))
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
            {{Session::get('error')}}
        </div>
    @endif

