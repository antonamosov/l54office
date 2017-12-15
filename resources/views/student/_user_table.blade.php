<table id="datatable-checkbox1" class="table table-striped table-bordered bulk_action">
    <thead id="student-table">
    <tr>
        <th>
            <input type="checkbox" class="checkbox checkbox-primary" id="check-all">
        </th>
        <th>Surname</th>
        <th>Name</th>
        <th>Phone number</th>
        <th>Born</th>
        <th>City</th>
        <th>Postal code</th>
        <th>University</th>
        <th>School</th>
        <th>E-mail</th>
        <th>Examination already taken?</th>
        <th>Examination fee + Courses + Book</th>
        <th>Sent E-mail?</th>
        <th>Confirmed</th>
        <th>Exam date</th>
        <th>Note</th>
        <th>Session</th>
        <th>Memo</th>
    </tr>
    </thead>


    <tbody>
    @foreach($students as $student)
        <tr
                @if($student->new)
                style="background-color: #FF96B0;"
                @endif
                @if($student->mailed)
                style="background-color: #fff33e;"
                @endif
                id="student-row_{{ $student->id }}">
<td>
    <input type="checkbox" id="single" student_id="{{ $student->id }}" >
    <a title="Edit student" style="margin-top:10px;" class="btn btn-info btn-xs" href="/user/edit/{{ $student->id }}"><i class="fa fa-pencil"></i></a>
    <a title="Select as memo" style="margin-top:10px;" class="btn {{ $student->select_as_memo ? 'btn-danger' : 'btn-default' }} btn-xs select-as-memo" id="{{ $student->id }}" href="#"><i class="fa fa-star"></i></a>
</td>
<td>{{ $student->surname }}</td>
<td>{{ $student->name }}</td>
<td>{{ $student->phone }}</td>
<td>{{ $student->born_in }}</td>
<td>{{ $student->city() }}</td>
<td>{{ $student->postal_code }}</td>
<td>{{ $student->university() }}</td>
<td>{{ $student->school() }}</td>
<td>{{ $student->email }}</td>
<td align="center">
    <div class="radio">
        <label>
            <input type="radio"
                   class=""
                   id="exam_already_taken"
                   value="1"
                   @if(\App\Student::YES == $student->exam_already_taken) checked @endif
                   student_id="{{ $student->id }}"
                   name="exam_already_taken_{{ $student->id }}"> si
            <input type="radio"
                   class=""
                   id="exam_already_taken"
                   value="2"
                   @if(\App\Student::NO == $student->exam_already_taken || !$student->exam_already_taken) checked @endif
                   student_id="{{ $student->id }}"
                   name="exam_already_taken_{{ $student->id }}"> no
        </label>
    </div>
</td>
<td>
    @foreach($student->exams as $exam)
            {{ $exam->title() }}
    @endforeach
</td>
<td>
    <div class="radio">
        <label>
            <input type="radio"
                   class="flat"
                   {{ $student->mail_pre_entry_date ? 'checked' : '' }}
                   disabled>
            <br />
            <input type="radio"
                   class="flat"
                   {{ $student->mail_confirmed_date ? 'checked' : '' }}
                   disabled>
            <br />
            <input type="radio"
                   class="flat"
                   {{ $student->mail_expired_date ? 'checked' : '' }}
                   disabled>
        </label>
    </div>
</td>
<td>
    <div class="radio">
        <label>
            <input id="confirmed" type="radio"
                   @if(\App\Student::YES == $student->confirmed) checked @endif
                   name="confirmed_{{ $student->id }}"
                   class="radio-button"
                   student_id="{{ $student->id }}"> si
        </label>
    </div>
</td>
<td>{{ localFormatOnlyDate($student->enrolment_exam) }}</td>
<td>{{ $student->note }}</td>
<td>{{ $student->session ? $student->session->description : '' }}</td>
<td>{{ $student->memo_1 }}</td>
</tr>
@endforeach
</tbody>
</table>
