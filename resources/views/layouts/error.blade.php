<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>An Error Has Occured</title>
  <link rel="stylesheet/less" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/381212/ceaser.less">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;700&family=Rubik:wght@300&display=swap" rel="stylesheet">
  <link href="{{ asset('assets/css/icons/icomoon/styles.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/mystyle.admin.css') . '?' . time() }}" rel="stylesheet">
</head>

<body>
    <style>
@color-primary: #0065A1;
@color-secondary: #0065A1;
@color-tertiary: #0065A1;
@color-primary-light: #0065A1;
@color-primary-dark: #0065A1;
@Distance: 1000px;

body{

}

html, body {
  position: relative;
  background: #ffffff ;
  min-height: 100%;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #0065A1;
  overflow: hidden;
  font-family: "Baloo 2", sans-serif;
}

.Container {
  text-align: center;
  position: relative;
}

.MainTitle {
  display: block;
  font-size: 2rem;
  font-weight: lighter;
  text-align: center;
}

.MainDescription {
  max-width: 50%;
  font-size: 1.2rem;
  font-weight: lighter;
}

.MainGraphic {
  position: relative;
}

.Cog {
  width: 10rem;
  height: 10rem;
  fill: #0065A1;
  transition: easeInOutQuint();
  animation: CogAnimation 5s infinite;
}

.Spanner {
  position: absolute;
  transform: rotate(20deg);
  top: 10%;
  left: 20%;
  width: 10rem;
  height: 10rem;
  fill: #0065A1;
  animation: SpannerAnimation 4s infinite;
}


.Hummingbird{
  position: absolute;
  width: 3rem;
  height: 3rem;
  fill: @color-primary;
  left: 50%;
  top: 50%;
  transform: translate(-50%,-50%);
}
.log{
    color: #0065A1;
    font-size:16px;
    margin-left: 8px;
}
a{
    text-decoration: none;
    font-weight: 550;
}

@keyframes CogAnimation {
    0%   {transform: rotate(0deg);}
    100% {transform: rotate(360deg);}
}

@keyframes SpannerAnimation {
    0%   {
      transform:
        translate3d(20px, 20px,1px)
        rotate(0deg);
    }
    10% {
      transform:
        translate3d(-@Distance, @Distance, 1px)
        rotate(180deg);
    }
    15% {
      transform:
        translate3d(-@Distance, @Distance, 1px)
        rotate(360deg);
    }
    20% {
      transform:
        translate3d(@Distance, -@Distance, 1px)
        rotate(180deg);
    }
    30% {
      transform:
        translate3d(-@Distance, @Distance, 1px)
        rotate(360deg);
    }
    40% {
      transform:
        translate3d(@Distance, -@Distance, 1px)
        rotate(360deg);
    }
    50% {
      transform:
        translate3d(-@Distance, @Distance, 1px)
        rotate(180deg);
    }
    100% {
      transform:
        translate3d(0, 0px, 0px)
        rotate(360deg);
    }

}


    </style>

  @yield('content')
</body>

</html>
