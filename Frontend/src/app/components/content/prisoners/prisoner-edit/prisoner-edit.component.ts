import { Component, OnInit } from '@angular/core';
import { Prisoner } from 'src/app/models/prisoner/prisoner.model';
import { PrisonerService } from 'src/app/services/prisoner/prisoner.service';
import { Router } from '@angular/router';
import { NgForm } from '@angular/forms';

@Component({
  selector: 'app-prisoner-edit',
  templateUrl: './prisoner-edit.component.html',
  styleUrls: ['./prisoner-edit.component.css']
})
export class PrisonerEditComponent implements OnInit {
  headerOfSite = 'Edycja więźnia';
  prisoner: Prisoner;
  id: number;

  constructor(private service: PrisonerService, private route: Router) { }

  ngOnInit() {
    let urlArr = this.route.url.split("/");
    this.id = Number(urlArr[3]);

    this.service.getPrisonerById(this.id).subscribe((res: any) => {
      this.prisoner = JSON.parse(res.prisoner);
    });
  }

  onSubmit(form: NgForm) {
    this.service.updatePrisoner(form.value).subscribe(
      elem => console.log('elem', elem),
      err => console.log('err', err),
      () => console.log("finished successfully")
    );
    
    console.log(form.value);
  }

}
