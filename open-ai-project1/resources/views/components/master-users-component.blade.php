@props(['title'])
@php
    $activeMenuItem = '';
    switch ($title) {
        case 'chat':
            $activeMenuItem = 'chat';
            break;
        case 'Vision':
            $activeMenuItem = 'Vision';
            break;
        case 'text-to-speach':
            $activeMenuItem = 'text-to-speach';
            break;
        case 'Speach-to-text':
            $activeMenuItem = 'Speach-to-text';
            break;
        case 'Setting':
            $activeMenuItem = 'Setting';
            break;
        case 'text-to-image':
            $activeMenuItem = 'text-to-image';
            break;
        default:
            $activeMenuItem = ''; 
            break;
    }
@endphp


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>HELLOAIBOX | {{$title}}</title>
    <style>
        .menu{
            width: 800px;
            height: 70px;
            border-radius: 20px;
            margin-left: 4px;
        }
        .menu button{
            padding: 0px 20px;
            height: 70px;
            border: none;
            /* background-color:#FDE767 ; */
            background-color:#DCF8C6 ;
        }
        button:nth-child(n+2){
            margin-left:-5px;
        }
        .chat{
            border-radius: 20px 0 0 20px ;
        }
        #setting{
            border-radius: 0px 20px 20px 0px;
        }
        a{
            text-decoration: none;
            color: black;
        }
        .cont{
            width: 840px;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 5px 25px rgba(1, 1, 1, 15%);
            margin-left: 260px;
            margin-top: 20px;
            margin-bottom: 30px;
            
        }
        h2{
            margin: 20px 680px 30px 15px ;
        }
        .pos1{
            margin-left: 15px;
        }
        .input1{
            width: 700px;
        }
        .meg{
            border: none;
            background-color: white;
        }
        .flex{
            display: flex;
        }
        .input2{
            margin-top: 20px ;
        }
        h6{
            margin-left: 20px;
            margin-top: 20px;
        }
        .voice{
            width: 800px;
        }
        textarea{
            width: 790px;
            height: 150px;
            border-radius: 10px;
            margin-left: 7px;
        }
        .menu button.active {
            /* background-color: #FDA403; */
            background-color: #128C7E;
        }
        .chattext1{
            /* background-color:#FDE767 ; */
            background-color:#DCF8C6 ;
            border-radius: 10px;
            font-weight: 700;
        }
        .chattext2{
            /* background-color:#FDA403 ; */
            background-color: #128C7E;
            border-radius: 10px;
            font-weight: 500;
        }
        .pos{
            display: flex;
        }
        .pos_alert{
            margin-left: 100px;
        }
        audio{
            margin:10px 0px 10px 250px;
        }
        #downloadButton_audio{
            margin-left: 320px;
        }
        .p_script{
            text-align: center;
        }
        .errorchat{
            margin-left: 70px;
        }
        .loading{
            margin-left: 70px;
        }
        .loader {
            display: flex;
            transition: all 0.4s;
        }
        .loading{
            margin-top: -10px;
            font-weight: 500;
        }

        .loader div {
            margin-left: 0.8rem;
            background-color: rgb(34, 34, 34);
            box-shadow: inset 2px 2px 10px black;
            border-radius: 100%;
            height: 0.5rem;
            width: 0.5rem;
        }

        .box-load1 {
            animation: brighten 1.2s infinite;
        }

        .box-load2 {
            animation: brighten 1.2s infinite;
            animation-delay: .2s;
        }

        .box-load3 {
            animation: brighten 1.2s infinite;
            animation-delay: .4s;
        }

            @keyframes brighten {
            100% {
                background-color: rgb(165, 165, 165);
                box-shadow: none;
            }
        }
        .custom-loader {
            width: 30px;
            height: 30px;
            display: grid;
            border-radius: 50%;
            -webkit-mask: radial-gradient(farthest-side,#0000 40%,#000 41%);
            background: linear-gradient(0deg ,#766DF480 50%,#766DF4FF 0) center/4px 100%,
                linear-gradient(90deg,#766DF440 50%,#766DF4BF 0) center/100% 4px;
            background-repeat: no-repeat;
            animation: s3 1s infinite steps(12);
            margin-left: 365px;
            }

            .custom-loader::before,
            .custom-loader::after {
            content: "";
            grid-area: 1/1;
            border-radius: 50%;
            background: inherit;
            opacity: 0.915;
            transform: rotate(30deg);
            }

            .custom-loader::after {
            opacity: 0.83;
            transform: rotate(60deg);
            }

            @keyframes s3 {
            100% {
                transform: rotate(1turn)
            }
            }
    </style>
</head>
<body>
    @include('pagefex.header')
    <div class="cont">
        @include('pagefex.menus', ['activeMenuItem' => $activeMenuItem])
        <section>
            {{$slot}}
        </section>
    </div>
</body>
</html>