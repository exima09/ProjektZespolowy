import { Component, OnInit } from '@angular/core';
import { PrisonerService } from 'src/app/services/prisoner/prisoner.service';
import { NgForm } from '@angular/forms';

@Component({
  selector: 'app-prisoner',
  templateUrl: './prisoner.component.html',
  styleUrls: ['./prisoner.component.css']
})
export class PrisonerComponent implements OnInit {
  headerOfSite = 'Rejestracja więźnia';

  constructor(private service: PrisonerService) { }

  ngOnInit() {
    this.resetForm();
  }

  resetForm(form?: NgForm) {
    if(form != null)
      form.resetForm();
      
    this.service.formData = {
      id: null,
      first_name: '',
      last_name: '',
      join_date: '',
      date_of_birdth: '',
      cell_id: null
    };
  }

  onSubmit(form: NgForm) {
    if(form.value.id == null)
      this.insertRecord(form);
  }

  insertRecord(form: NgForm) {
    this.service.postPrisoner(form.value).subscribe(res => {
      console.log("Prisoner inserted successfully")
      this.resetForm(form);
    });
  }
}
