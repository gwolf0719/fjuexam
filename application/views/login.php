
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <base src="<?=base_url();?>">
    

    <title>大考中心管理平台</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="./assets/css/custom.css">
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
 

    <script>
      $(function(){
        $("#login").click(function(){
            $.post("./api/login",{
              user_id:$("#user_id").val(),
              user_pwd:$("#user_pwd").val(),
            },function(data){
              alert(data.sys_msg);
              if(data.sys_code=="200"){
                location.href="./";
              }
            },"json")
        })
      })
    </script>
    
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
      <a class="navbar-brand" href="#">大考中心管理平台</a>
      

      <!-- <div class="collapse navbar-collapse" id="navbarsExampleDefault"> -->
        <!-- <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul> -->
        <!-- <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> -->
      <!-- </div> -->
    </nav>

    <main role="main" class="container">

        <div class="row">
            <div class="col-sm"></div>
            <div class="col-sm">
                <form action="" id="login_form">
                  
                    <div class="form-group">
                      <label for="user_id" class="control-label">使用者帳號</label>
                      <div class="">
                        <input type="text" name="" id="user_id" class="form-control" value="" required="required" pattern="" title="">
                      </div>
                    </div>
                   
                    
                    <div class="form-group">
                      <label for="user_pwd" class="control-label">請輸入密碼</label>
                      <div class="">
                        <input type="password" name="" id="user_pwd" class="form-control" value="" required="required" pattern="" title="">
                      </div>
                    </div>
                    
                    <div class="form-grop text-right">
                        <button type="button" class="btn btn-primary " id="login">送出登入</button>
                    </div>
                    
                    

                </form>
            </div>
            <div class="col-sm"></div>
            
            
        </div>


    </main><!-- /.container -->
 </body>
</html>
