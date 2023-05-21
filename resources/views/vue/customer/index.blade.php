<!doctype html>
<html lang="en">
<head>
    @include("vue.layouts.head-tag")
    <script src="{{asset("vue/customer/customer-main.js")}}" defer></script>
    <style>
        body {
            background: #76b852; /* fallback for old browsers */
            background: rgb(141,194,111);
            background: linear-gradient(90deg, rgba(141,194,111,1) 0%, rgba(118,184,82,1) 50%);
            font-family: "Roboto", sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        header, footer{
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }
        main{
            min-height: calc(100vh - 100px);
            position: relative;
            z-index: 1;
            max-width: 360px;
            margin: 15px auto ;
            padding: 45px;
            text-align: center;
        }

        .text_decoration_price{
            text-decoration: line-through;
        }

        .form-shadow{
            background-color: white;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }
    </style>
</head>
<body id="app"  class="container-xxl body-container container">

<app/>

</body>
</html>

