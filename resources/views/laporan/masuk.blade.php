
        <table class="table table-stripped" border="5">
                    <thead>
                           <tr>
                               <th colspan="7"><b>Data Surat Masuk</b></th>
                               <th></th>
                               <th></th>
                               <th></th>
                               <th></th>
                               <th></th>
                               <th></th>
                           </tr>
                        <tr>
                        <th align="center"><b>No</b></th>
                        <th align="center"><b>Surat Dari</b></th>
                        <th align="center"><b>Nomor</b></th>
                        <th align="center"><b>Perihal</b></th>
                        <th align="center"><b>Catatan</b></th>
                        <th align="center"><b>Jenis Surat</b></th>
                        <th align="center"><b>Status</b></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $no=1;?>
                        @foreach($masuk as $row)
                        <tr>
                            <td align="left">{{$no++}}</td>
                            <td align="center">{{$row->dari}}</td>
                            <td align="center">{{$row->nomor}}</td>
                            <td align="center">{{$row->perihal}}</td>
                            <td align="center">{{$row->catatan}}</td>
                            <td align="center">{{$row->kategori->nama}}</td>
                            <td align="center">{{$row->status}}</td>
                            
                        </tr>
                        
                         @endforeach
                         <?php $no++;?>
                        
                       
                    </tbody>
                </table>