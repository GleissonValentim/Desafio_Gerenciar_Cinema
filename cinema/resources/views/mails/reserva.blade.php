<div style="font-family: Arial, Helvetica, sans-serif;">
    <h2>Seu ingressos estão confirmados!</h2>
    <p>Boas notícias: seus ingressos para o seguinte filme foi confirmado com sucesso!</p>

    <ul>
        <li>{{ $data['filme'] }}</li>
        <li>{{ $data['sala'] }}</li>
        <li>{{ $data['data'] }}</li>
        <li>{{ $data['horario'] }}</li>
    </ul>

    <h4>Assentos: </h4>

    @foreach($data['assentos'] as $assento)
        <ul>
            <li>{{ $assento }}</li>
        </ul>
    @endforeach

    <div style="display: flex; flex-direction: column;">
        @foreach($data['identificador'] as $identificador)
            {{ $qrcode = QRCode::text('http://127.0.0.1:8000/ingressos/confirmar/'.$identificador.'')->svg() }}
        @endforeach
    </div>

    <p>Não esqueça de levar este e-mail ou mostrar o número do ingresso na entrada.</p>
    <p>Estamos ansiosos para te ver lá!</p>
</div>