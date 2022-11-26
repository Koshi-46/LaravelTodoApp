<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Todoリスト</title>
  <link href="../../css/reset.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="todo">
    <div class="main-nav">
      <h1 class="title">Todo List</h1>
    </div>


    @if (count($errors) > 0)
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
    @endif

    <form action="/todo" method="post" class="flex between mb-30">
      @csrf
      <input type="text" class="input" name="content" />
      <select name="genre_id" class="select">
        @foreach($genres as $genre)
        <option value="{{ $genre->id }}">{{ $genre->content }}</option>
        @endforeach
      </select>
      <input class="add" type="submit" value="追加" />
    </form>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">作成日</th>
          <th scope="col">タスク名</th>
          <th scope="col">削除</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($todos as $todoList)
        <tr>
          <td>{{ $todoList->created_at }}</td>
          <td class="todo-content">
            <form action="{{ route('todo.update', ['id' => $todoList->id]) }}" method="post">
              @csrf
              <input type="text" class="input" name="content" value="{{ $todoList->content }}" />
              <select name="genre_id" class="select-tag">
                <option value="1" @if($todoList->genre_id === 1 ) selected @endif>家事</option>
                <option value="2" @if($todoList->genre_id === 2 ) selected @endif>勉強</option>
                <option value="3" @if($todoList->genre_id === 3 ) selected @endif>運動</option>
                <option value="4" @if($todoList->genre_id === 4 ) selected @endif>食事</option>
                <option value="5" @if($todoList->genre_id === 5 ) selected @endif>移動</option>
              </select>
              <button type="submit" class="btn btn-outline-success">更新</button>
            </form>
          </td>
          <td>
            <form action="{{ route('todo.delete', ['id' => $todoList->id]) }}" method="post">
              @csrf
              <button type="submit" class="btn btn-outline-danger">削除</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
</body>

</html>