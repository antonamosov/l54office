<tr>
    <td align="center" colspan="5" bgcolor="#FFFFFF">
        <div align="right">
            <hr/>
        </div>
    </td>
</tr>
<tr>
    <td align="center" bgcolor="#96B524">
        <div align="center">
                        <span class="size">
                        <input type="submit" value="Print Records" id="{{ $student->id }}" class="button print_records"/>
                        <br><span class="print_receipt" style="color:red;"></span>
                        </span>
        </div>
    </td>
    <td align="center" bgcolor="#96B524">
        <div align="center">
                        <span class="size">
                        <input type="submit" value="Print Receipt" id="{{ $student->id }}" class="button print_receipt"/>
                        <br><span class="print_receipt" style="color:red;"></span>
                        </span>
        </div>
    </td>
    <td align="center" bgcolor="#96B524">
        <div align="center">
                        <span class="size">
                        <input type="submit" value="Print Course invoice" class="button print_course_invoice" id="{{ $student->lastInvoice() ? $student->lastInvoice()->id : '' }}"/>
                            <br><span class="print_course_invoice" style="color:red;"><span></span></span>
        </div>
    </td>
    <td align="center" bgcolor="#96B524">
        <div align="center">
                        <span class="size">
                        <input type="submit" value="Print Toeic invoice" class="button print_toeic_invoice" id="{{ $student->lastInvoice() ? $student->lastInvoice()->id : '' }}"/>
                            <br><span class="print_toeic_invoice" style="color:red;"><span></span></span>
        </div>
    </td>
    <td align="center" bgcolor="#999999">
        <div align="right"><span class="size">
                        <input type="submit" value="Save" class="button"/>
                        </span>
        </div>
    </td>
</tr>