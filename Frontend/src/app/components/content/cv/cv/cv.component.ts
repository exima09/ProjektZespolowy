import { Component, OnInit } from '@angular/core';
import { Cv } from 'src/app/models/cv/cv.model';
import { CvService } from 'src/app/services/cv/cv.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-cv',
  templateUrl: './cv.component.html',
  styleUrls: ['./cv.component.css']
})
export class CvComponent implements OnInit {
    headerOfSite = 'CV pracownika';
    cv: Cv;
    id: number;

  constructor(private service: CvService, private route: Router) { }

  ngOnInit() {
      const urlArr = this.route.url.split("/");
      this.id = Number(urlArr[2]);

      this.service.getCvById(this.id).subscribe((res: any) => {
        this.cv = JSON.parse(res.cv);
    });
}

}
