import { Component, OnInit } from '@angular/core';
import { FormArray, FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { QuotationService } from '../Services/quotation.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-form',
  templateUrl: './form.component.html',
  styleUrls: ['./form.component.css']
})
export class FormComponent implements OnInit {
  quotation: FormGroup;
  quotationResult : any = null ;
  constructor(
    public fb: FormBuilder,
    public _quotation: QuotationService,
    public router : Router
  ) {
    this.quotation = this.fb.group({
      age: this.fb.array([]),
      currency_id: ['EUR', Validators.required],
      start_date: ['', Validators.required],
      end_date: ['', Validators.required]
    });
   }

  ngOnInit() {
    this.addAgeControl();
  }

  get ageControls() {
    return this.quotation.get('age') as FormArray;
  }

  addAgeControl() {
    this.ageControls.push(this.fb.control(18, [Validators.required, Validators.pattern(/^\d+$/)]));
  }

  removeAgeControl(index: number) {
    this.ageControls.removeAt(index);
  }
  submit() {
    const that = this;
    if (this.quotation.valid) {
      this._quotation.create(this.quotation.value).subscribe({
        next(r ) {
          that.quotationResult = r;
        },
        error(e) {
          if (e.status == 401) {
            that.router.navigate(['']);
          }

        }
      })
    }
  }
}
