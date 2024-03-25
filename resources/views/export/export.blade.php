<div class="body-table">
    <table class="table table-bordered" style="border: 1px solid black; width:100%">
        <thead>
            <tr>
                <th colspan="3" style="border: 1px solid black;">ยุทธศาสตร์-กลยุทธ์-แผนงาน/โครงการ</th>
                <th colspan="2" style="border: 1px solid black;">วัตถุประสงค์</th>
                <th colspan="2" style="border: 1px solid black;">เป้าหมาย</th>
                <th colspan="2" style="border: 1px solid black;">งบประมาณ</th>
                <th colspan="2" style="border: 1px solid black;">กิจกรรม/ขั้นตอน</th>
                <th colspan="2" style="border: 1px solid black;">ตัวชี้วัด</th>
            </tr>
        </thead>
        <tbody>
            @php
            $Number = 1;
            @endphp
            @foreach($getAccountBudgetCenter as $index => $row)
            <tr>
                <td colspan="3" style="border: 1px solid black;"><b><u>{{ $Number }}.{{ $row[1] }}</u></b></td>
                <td colspan="2" style="border: 1px solid black;"></td>
                <td colspan="2" style="border: 1px solid black;"></td>
                <td colspan="2" style="border: 1px solid black;"></td>
                <td colspan="2" style="border: 1px solid black;"></td>
                <td colspan="2" style="border: 1px solid black;"></td>
            </tr>
            <tr>
                <td colspan="13" style="border: 1px solid black; height:100px">{!! $row[2] !!}</td>
            </tr>
            @php
            $SubNumber = 1;
            @endphp
            @foreach($getAccountBudgetCenterSub as $index => $rowsub)
            @if ($rowsub[1] == $row[0])
            <tr>
                <td colspan="3" style="border: 1px solid black;">{{ $Number }}.{{ $SubNumber }} {{ $rowsub[2] }}</td>
                <td colspan="2" style="border: 1px solid black;height:100px">{!! $rowsub[4] !!}</td>
                <td colspan="2" style="border: 1px solid black;height:100px">{{ $rowsub[7] }}</td>
                <td colspan="2" style="border: 1px solid black;">{{ $rowsub[3] }}</td>
                <td colspan="2" style="border: 1px solid black;height:100px">
                    @foreach($getAccountBudgetCenterActivity as $index => $rowsubActivity)
                    @if ($rowsubActivity[1] == $rowsub[0])
                    {{ $rowsubActivity[2] }}<br>
                    @endif
                    @endforeach
                </td>
                <td colspan="2" style="border: 1px solid black;height:100px">{{ $rowsub[8] }}</td>
            </tr>
            @endif
            @php
            $SubNumber++;
            @endphp
            @endforeach
            @php
            $Number++;
            @endphp
            @endforeach
        </tbody>
    </table>
</div>