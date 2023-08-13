{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>--}}

{{--<button onclick="get_price()" id="send_btn">test</button>--}}

{{--<script>--}}
{{--    function get_price(){--}}
{{--        document.getElementById("send_btn").innerText="loadin";--}}

{{--        const xhr = new XMLHttpRequest();--}}
{{--        xhr.open("POST", "https://cjpar6hk4f.execute-api.us-east-1.amazonaws.com/api-getway/from-api-mmm");--}}
{{--        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");--}}
{{--        const body = JSON.stringify({--}}
{{--            title: "moatasem karwan",--}}
{{--            body: "My POST request",--}}
{{--            userId: "jkllkl",--}}
{{--        });--}}

{{--        xhr.send(body);--}}
{{--        document.getElementById("send_btn").innerText="test22";--}}


{{--    }--}}
{{--</script>--}}



<button onclick="get_price()" id="send_btn">test</button>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

<script>
    function get_price(){
        document.getElementById("send_btn").innerText="loadin";

        $.ajax({
            type:'post',
            url:'https://cjpar6hk4f.execute-api.us-east-1.amazonaws.com/api-getway/from-api-mmm',
            data:{
                '_token':'{{csrf_token()}}',
                'name':'ajax moatasem',


            },
            success:function (data){


            }
        });
        document.getElementById("send_btn").innerText="test22";


    }
</script>
