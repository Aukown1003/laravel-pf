$(function() {
  get_data();
});

function get_data() {
  $.ajax({
      url: "result/ajax/",
      dataType: "json",
      success: data => {
        // データを検索し削除
        $("#comment-data").find(".comment-visible").remove();

        // 新規データの埋め込み
        for (var i = 0; i < data.comments.length; i++) {
            var html = `
                        <td class="text-center">
                          @if (${data.books[i].image})
                            <img src="${data.books[i].image}" class="books_image">
                          @else
                            <img src="{{ asset('img/no_image.png') }}" class="books_image">
                          @endif
                        </td>

                        <td class="align-middle">${data.books[i].title}</td>

                        <td class="align-middle">${data.books[i].user.name}</td>

                        <td class="align-middle"><a href="{{ route('books.show', ${data.books[i]}) }}" class="btn btn-primary">詳細</a></td>

                        @if (Auth::id() == ${data.books[i].user.id})
                          <td class="align-middle"><a href="{{ route('books.edit', ${data.books[i]}) }}" class="btn btn-success">編集</a></td>
                          <form action="{{ route('books.destroy', ${data.books[i]}) }}" method="post">
                            @csrf
                            @method('delete')
                            <td class="align-middle"><button type="submit" class="btn btn-danger" onclick="delete_alert(event);return false;">削除</button></td>
                          </form>
                        @else
                          <td></td>
                          <td></td>
                        @endif
                    `;

            // 作成したhtml要素の埋め込み
            $("#comment-data").append(html);
        }
      },
      error: () => {
          alert("ajax Error");
      }
  });

  setTimeout("get_data()", 5000);
}