<table border="1">
    <thead>
        <tr>
            <th>Nama</th>
            <th>WhatsApp</th>
            <th>Nominal</th>
            <th>Metode Pembayaran</th>
            <th>Pesan</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($donations as $donation)
        <tr>
            <td>{{ $donation->name }}</td>
            <td>{{ $donation->whatsapp }}</td>
            <td>Rp {{ number_format($donation->nominal,0,",",".") }}</td>
            <td>{{ $donation->payment_method }}</td>
            <td>{{ $donation->message }}</td>
            <td>{{ $donation->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<tbody>
    @forelse($donations as $donation)
        <tr>
            <td>{{ $donation->name }}</td>
            <td>{{ $donation->whatsapp }}</td>
            <td>Rp {{ number_format($donation->nominal,0,",",".") }}</td>
            <td>{{ $donation->payment_method }}</td>
            <td>{{ $donation->message }}</td>
            <td>{{ $donation->created_at }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="6">Belum ada donasi masuk.</td>
        </tr>
    @endforelse
</tbody>
