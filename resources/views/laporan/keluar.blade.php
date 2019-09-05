        <table class="table table-stripped" border="1">
                    <thead>
                        <tr>
                               <th colspan="7"><b>Data Surat Keluar</b></th>
                               <th></th>
                               <th></th>
                               <th></th>
                               <th></th>
                               <th></th>
                               <th></th>
                           </tr>
                        <tr>
                        <th align="center"><b>No</b></th>  
                        <th align="center"><b>Surat Kepada</b></th>
                        <th align="center"><b>Nomor Surat</b></th>
                        <th align="center"><b>Perihal</b></th>
                        <th align="center"><b>Catatan</b></th>
                        <th align="center"><b>Jenis Surat</b></th>
                        <th align="center"><b>Status</b></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $no=1;?>
                        @foreach($keluar as $row)
                        <tr>
                            <td align="left">{{$no++}}</td>
                            <td>{{$row->kepada}}</td>
                            <td>{{$row->nomor}}</td>
                            <td>{{$row->perihal}}</td>
                            <td>{{$row->catatan}}</td>
                            <td>{{$row->kategori->nama}}</td>
                            <td>{{$row->status}}</td>
                            
                            
                        </tr>
                       
                         @endforeach
                          <?php $no++;?>
                        
                       
                    </tbody>
                </table>