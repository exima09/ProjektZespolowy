import { Component, OnInit } from '@angular/core';
import { WorkerService } from 'src/app/services/worker/worker.service';
import { Router } from '@angular/router';
import { Worker } from 'src/app/models/worker/worker.model';

@Component({
  selector: 'app-worker',
  templateUrl: './worker.component.html',
  styleUrls: ['./worker.component.css']
})
export class WorkerComponent implements OnInit {
  headerOfSite = 'Szczegóły pracownika';
  worker: Worker;
  id: number;

  constructor(private service: WorkerService, private route: Router) { }

  ngOnInit() {
    const urlArr = this.route.url.split("/");
    this.id = Number(urlArr[2]);

    this.service.getWorkerById(this.id).subscribe((res: any) => {
      this.worker = JSON.parse(res.worker);
    });
  }
}
