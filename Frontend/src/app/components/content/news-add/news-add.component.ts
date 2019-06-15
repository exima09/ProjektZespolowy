import {Component, OnInit} from '@angular/core';
import {NewsService} from "../../../services/news/news.service";
import {FormBuilder, FormControl, FormGroup, NgForm, Validators} from "@angular/forms";
import {MatSnackBar} from "@angular/material";

@Component({
  selector: 'app-news-add',
  templateUrl: './news-add.component.html',
  styleUrls: ['./news-add.component.css']
})
export class NewsAddComponent implements OnInit {
  headerOfSite = "Dodaj aktualności";
  loading = false;
  anyErrors = false;
  fileError = "";
  dataForm: FormGroup;
  result = "";
  form = new FormGroup({
    title: new FormControl(''),
    text: new FormControl(''),
    file: new FormControl(''),
  });

  constructor(private service: NewsService, private _formBuilder: FormBuilder, private snackService: MatSnackBar) { }

  ngOnInit() {
    this.dataForm = this._formBuilder.group({
      title: ['', Validators.required],
      text: ['', Validators.required],
      file: [null, Validators.required],
    });
  }




  readURL(event): void {
    let reader = new FileReader();

    if(event.target.files && event.target.files.length) {
      try {
        const [file] = event.target.files;
        reader.readAsDataURL(file);
        this.checkFile(file);
        reader.onload = () => {
          this.form.patchValue({
            file: file
          });
        };
        this.fileError = "Przesłano poprawny plik";
      } catch (err) {
        this.fileError = err;
        this.anyErrors = true;
      }
    }
  }

  checkFile(file: File) {
    if (file.type !== "image/jpeg" && file.type !== "image/png") {
      throw new Error("File not valid, need to be .jpg or .png")
    }
    if (file.size > 5242880) {
      throw new Error("File not valid, need to be smaller than 5Mb")
    }
  }

  onSubmit() {
    const applicationForm = new FormData();
    for (const data in this.form.value) {
      applicationForm.set(data, this.form.value[data]);
    }
    this.service.postNews(applicationForm).subscribe(
      res => {
        this.snackService.open("Dodano aktualność");
        this.form.reset();
        this.fileError = "";
        document.getElementById("exampleFormControlFile1").value = "";
      },
      err => this.snackService.open(`Nie udało się dodać aktualności`)


    );
  }
}
