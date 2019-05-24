import { Component, OnInit } from '@angular/core';
import { Cv } from 'src/app/models/cv/cv.model';
import { CvService } from 'src/app/services/cv/cv.service';

@Component({
  selector: 'app-cv-manage',
  templateUrl: './cv-manage.component.html',
  styleUrls: ['./cv-manage.component.css']
})
export class CvManageComponent implements OnInit {
  headerOfSite = 'Zarządzaj podaniami';
  cvs: Cv[] = [];


  constructor(private service: CvService) { }

  ngOnInit() {
    this.service.getCvs().subscribe((res:any) => {
      this.cvs = JSON.parse(res.applications)
      console.log(this.cvs)
    });
  }

}
