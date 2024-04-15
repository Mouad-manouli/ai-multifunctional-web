@props(['title'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>HELLOAIBOX | {{$title}}</title>
    <style>
        
        .logo{
            margin-left: 40px;
            font-weight: bold;
        }
        .logout{
            margin-right: 40px;
        } 
        table{
            width: 1000px;
            text-align: center;
            margin-left: 180px;
            margin-bottom: 20px;
        }
        .add{
            margin-top: 20px;
            margin-left: 1150px;
            margin-bottom: 20px;
        }
        tr:nth-child(odd){
            background-color: rgb(244, 244, 244);
        }
        .action{
            display: flex;
            margin-left: 130px;
            width: 200px;
        }
        .paginate{
            margin-left: 400px;
            margin-right: 400px;
        }
        tr{
            height: 50px;
        }
        .box{
            color: white;
        }
        .form_add{
            width: 1000px;
            margin-left: 200px;
            margin-top: 40px;
        }
        .alertt{
            margin-top: 20px;
            margin-left: 60px;
            margin-right: 60px;
        }
        .search{
            display: flex;
            margin-left: 500px;
            width: 300px;
            margin-bottom: 10px;
        }
        .pos_image{
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 10px;
            margin-bottom: 20px;
        }
        .title_image{
            text-align: center;
            margin-top: 10px;
            
        }
        .image{
            border-radius: 20px;
        }
        .btn_image{
            margin-left: 600px;
            margin-bottom: 10px;
        }
        
    </style>
</head>
<body>
    @include('pagefex.header')
    <section>
        {{$slot}}
    </section>
</body>
</html>