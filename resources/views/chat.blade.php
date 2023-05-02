<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap Textarea Form Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container mt-5">
        <form method="POST">
            @csrf
            <div class="form-group">
            <label for="exampleFormControlTextarea1">作成したいプログラムを入力してください</label>
            <textarea class="form-control" rows="1" name="sentence">{{ isset($sentence) ? $sentence : '' }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">送信</button>
        </form>
        
    {{-- 結果 --}}
    @php
        $flg = isset($chat_response) ? true : false;
    @endphp
    @if($flg)
    <div class="form-group">
        <label for="exampleFormControlTextarea1">処理に失敗しました。上記の文書で再度入力してください。</label>
        
        <label style='color:red'>{{ isset($chat_response) ? $chat_response : '' }} </label>
    <div>
    @endif
    
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </body>
</html>