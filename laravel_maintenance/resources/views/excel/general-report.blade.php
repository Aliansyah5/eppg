<table>
    <thead>
        <tr>
            <th><b>Status</b></th>
            <th><b>Kode Maintenance</b></th>
            <th><b>Kode Asset</b></th>
            <th><b>Nama Asset</b></th>
            <th><b>Kategori Maintenance</b></th>
            <th><b>Lama Maintenance</b></th>
            <th><b>Mulai Maintenance</b></th>
            <th><b>Perkiraan Selesai</b></th>
            <th><b>Selesai Maintenance</b></th>
            <th><b>Terakhir Maintenance</b></th>
            <th><b>Keterangan</b></th>
            <th><b>Lokasi</b></th>
            <th><b>Hour Meter</b></th>
            <th><b>Assignee</b></th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>Maintenance Selesai</td>
            <td>{{ $item->kode }}</td>
            <td>{{ $item->Kode_Asset }}</td>
            <td>{{ $item->Nama_Asset }}</td>
            <td>{{ $item->category }}</td>
            <td>{{ $item->lama_mt }} Hari</td>
            <td>{{ date('d-m-Y', strtotime($item->tgl_realisasi)) }}</td>
            <td>{{ date('d-m-Y', strtotime($item->tgl_perkiraan))  }}</td>
            <td>{{ date('d-m-Y', strtotime($item->tgl_selesaimt))  }}</td>
            <td>{{ date('d-m-Y', strtotime($item->tgl_lastmaintdate))  }} </td>
            <td>{{ $item->keterangan }}</td>
            <td>{{ $item->lokasi }}</td>
            <td>{{ $item->MaintHour }} Jam</td>
            <td>{{ $item->assignee }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
