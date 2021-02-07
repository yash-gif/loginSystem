<!-- code for the dismissable alert -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    @import url(https://fonts.googleapis.com/css?family=Lobster);

@import url(https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css);




.alert .inner {
  display: block;
  padding: 6px;
  margin: 6px;
  border-radius: 3px;
  border: 1px solid rgb(180,180,180);
  background-color: rgb(212,212,212);
}

.alert .close {
  float: right;
  margin: 3px 12px 0px 0px;
  cursor: pointer;
}

.alert .inner,.alert .close {
  color: rgb(88,88,88);
}

.alert input {
  display: none;
}

.alert input:checked ~ * {
  animation-name: dismiss,hide;
  animation-duration: 300ms;
  animation-iteration-count: 1;
  animation-timing-function: ease;
  animation-fill-mode: forwards;
  animation-delay: 0s,100ms;
}

.alert.error .inner {
  border: 1px solid rgb(238,211,215);
  background-color: rgb(242,222,222);
}

.alert.error .inner,.alert.error .close {
  color: rgb(185,74,72);
}

.alert.success .inner {
  border: 1px solid rgb(214,233,198);
  background-color: rgb(223,240,216);
}

.alert.success .inner,.alert.success .close {
  color: rgb(70,136,71);
}

@keyframes dismiss {
  0% {
    opacity: 1;
  }
  90%, 100% {
    opacity: 0;
    font-size: 0.1px;
    transform: scale(0);
  }
}


}

 </style>
</head>

</html>