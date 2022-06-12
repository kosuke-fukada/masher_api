<html>
    <head>
        <style>
            header {
                display: flex;
                padding: 10px;
                justify-content: start;
                background-color: #04B4AE;
            }
            .summary {
                margin: 10px;
            }
            table {
                border: 1px solid black;
                border-collapse: collapse;
            }
            th {
                background-color: #D8D8D8;
                padding: 0 1rem;
                border: 1px solid black;
            }
            td {
                padding: 0 1rem;
                white-space: pre-wrap;
                border: 1px solid black;
            }
            footer {
                margin: 20px 0;
                padding: 10px;
                text-align: center;
                background-color: #04B4AE;
            }
            footer p {
                color: #FFFFFF;
                font-size: small;
            }
            a {
                text-decoration: none;
            }
            p {
                margin: 0;
            }
        </style>
    </head>
    <body>
        <div>
            <header>
                <img src="{{ $webUrl }}/masher_logo_white.png" height="32px">
            </header>
            <div class="summary">
                <p>
                    この度はお問い合わせいただき誠にありがとうございます。<br>
                    以下の内容で承りました。<br>
                    内容を確認の上、1週間程度で返信いたしますので今しばらくお待ちください。
                </p>
            </div>
            <table>
                <tbody>
                    <tr>
                        <th>お名前</th>
                        <td>{{ $name }}</td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td>{{ $email }}</td>
                    </tr>
                    <tr>
                        <th>お問い合わせ内容</th>
                        <td>{{ $body }}</td>
                    </tr>
                </tbody>
            </table>
            <footer>
                <p>Masher | Twitter無限いいねボタン</p>
                <a href="{{ $webUrl }}"><p>{{ $webUrl }}</p></a>
            </footer>
        </div>
    </body>
</html>
