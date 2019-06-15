import { Component, OnInit } from '@angular/core';
import {NewsService} from "../../../services/news/news.service";
import {News} from '../../../models/news/news.model'


@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  headerOfSite = "Aktualności";
  private news: News[] = [];
  constructor(private service: NewsService) { }

  ngOnInit() {
    this.newsLoad();
  }

  newsLoad = () => this.service.getNews().subscribe(
    (res:any)=>this.news = JSON.parse(res.news))

}
