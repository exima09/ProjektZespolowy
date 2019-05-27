import { Component, OnInit } from '@angular/core';
import { WorkerService } from 'src/app/services/worker/worker.service';
import { Worker } from 'src/app/models/worker/worker.model';

@Component({
  selector: 'app-workers-list',
  templateUrl: './workers-list.component.html',
  styleUrls: ['./workers-list.component.css']
})
export class WorkersListComponent implements OnInit {
  headerOfSite = 'Pracownicy';
  workers: Worker[] = [];

  constructor(private service: WorkerService) { }

  ngOnInit() {
    this.loadWorkers();
  }

  loadWorkers(){
    this.service.getWorkers().subscribe((res: any) => {
      this.workers = JSON.parse(res.workers);
    });
  }

  finishWork(id: number) {
    this.service.finishWork(id).subscribe(() => {
      this.loadWorkers();
    })
    console.log("finish work id: " +id);
  }
}
