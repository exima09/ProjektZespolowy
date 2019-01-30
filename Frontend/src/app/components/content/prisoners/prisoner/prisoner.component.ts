import {Component, OnInit} from '@angular/core';
import {PrisonerService} from 'src/app/services/prisoner/prisoner.service';
import {NgForm} from '@angular/forms';
import {AuthenticationService} from "../../../../services/authorization.service";

@Component({
  selector: 'app-prisoner',
  templateUrl: './prisoner.component.html',
  styleUrls: ['./prisoner.component.css']
})
export class PrisonerComponent implements OnInit {
  headerOfSite = 'Rejestracja więźnia';

  constructor(private service: PrisonerService, private auth: AuthenticationService) {
    this.auth.checkLogin();
  }

  ngOnInit() {
    this.resetForm();
  }

  resetForm(form?: NgForm) {
    if (form != null) {
      form.resetForm();
    }
    this.service.formData = {
      prisonerId: null,
      firstName: '',
      lastName: '',
      joinDate: '',
      dateOfBirth: '',
      cellId: null
    };
  }

  onSubmit(form: NgForm) {
    if (form.value.id == null) {
      if (localStorage.getItem('token')) {
        this.insertRecord(form);
      }
    }
  }

  insertRecord(form: NgForm) {
    this.service.postPrisoner(form.value).subscribe(res => {
      console.log('Prisoner inserted successfully');
      this.resetForm(form);
    });
  }
}
