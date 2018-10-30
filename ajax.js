<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.fa {
    font-size: 50px;
    cursor: pointer;
    user-select: none;
}

.fa:hover {
  color: red;
}
</style>
</head>
<body>

<p>Click on the icon to toggle between thumbs-up and thumbs-down (like/dislike):</p>

<i onclick="myFunction(this)" class="fa fa-thumbs-up"></i>

<script>
function myFunction(x) {
    x.classList.toggle("fa-thumbs-down");
}
</script>

</body>
</html>