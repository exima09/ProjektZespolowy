import { Component, OnInit } from '@angular/core';
import { Cv } from 'src/app/models/cv/cv.model';
import { CvService } from 'src/app/services/cv/cv.service';
import { MatSnackBar } from '@angular/material';

@Component({
  selector: 'app-cv-manage',
  templateUrl: './cv-manage.component.html',
  styleUrls: ['./cv-manage.component.css']
})
export class CvManageComponent implements OnInit {
  headerOfSite = 'Zarządzaj podaniami';
  cvs: Cv[] = [];
  cv: Cv;

  constructor(private service: CvService, public snackBar: MatSnackBar) { }

  ngOnInit() {
    this.service.getCvs().subscribe((res:any) => {
      this.cvs = JSON.parse(res.applications)
    });
  }

  changeApplicationStatus(cvId: number, statusId: number){
    this.service.changeCvStatus(cvId, statusId).subscribe(() => {
    },
    err => {
      this.snackBar.open("Błąd", "Wystąpił błąd podczas aktualizacji danych", {
        duration: 2000,
        panelClass: ['service-snackbar']
      });
    },
    () => {
      this.service.getCvs().subscribe((res:any) => {
      this.cvs = JSON.parse(res.applications)
      console.log(this.cvs);
      });
    });
  }
    
  sortByIdNew() {
    this.cvs.sort((a, b) => b.id - a.id);
  }

  sortByIdOld() {
    this.cvs.sort((a, b) => a.id - b.id);
  }

  sortByNameAZ() {
    this.cvs.sort((a, b) => a.lastName.localeCompare(b.lastName));
  }

  sortByNameZA() {
    this.cvs.sort((a, b) => b.lastName.localeCompare(a.lastName));
  }
}
