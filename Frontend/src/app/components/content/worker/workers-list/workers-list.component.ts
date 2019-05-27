import {Component, Inject, OnInit} from '@angular/core';
import { WorkerService } from 'src/app/services/worker/worker.service';
import { Worker } from 'src/app/models/worker/worker.model';
import {MatDialog, MatDialogRef} from '@angular/material';


@Component({
  selector: 'app-workers-list',
  templateUrl: './workers-list.component.html',
  styleUrls: ['./workers-list.component.css']
})
export class WorkersListComponent implements OnInit {
  headerOfSite = 'Pracownicy';
  workers: Worker[] = [];

  constructor(private service: WorkerService, public dialog: MatDialog) { }

  ngOnInit() {
    this.loadWorkers();
  }

  loadWorkers() {
    this.service.getWorkers().subscribe((res: any) => {
      this.workers = JSON.parse(res.workers);
    });
  }

  finishWork(id: number) {
    this.service.finishWork(id).subscribe(() => {
      this.loadWorkers();
    })
  }

  openDialog(id: number): void {
    const dialogRef = this.dialog.open(DialogPopconfirmComponent, {
      width: '250px'
    });

    dialogRef.afterClosed().subscribe(result => {
      if (result) {
        this.finishWork(id);
      }
    });
  }

}

@Component({
  selector: 'app-dialog-release-employee',
  templateUrl: 'dialog.html',
})
export class DialogPopconfirmComponent {

  constructor(public dialogRef: MatDialogRef<DialogPopconfirmComponent>) {}

}
